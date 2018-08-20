<?php

class File extends Base
{
	protected $ip;
	protected $name;
	protected $size;
	protected $original_name;
	protected $creation_date;
	protected $deletion_date;
	protected $file_type;
	protected $active;

	public function createFromUpload()
	{
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->name = $this->shortenName($_FILES['file']['name']);
		$this->size = $_FILES['file']['size'];
		$this->original_name = $_FILES['file']['name'];
		$this->creation_date = time();
		$this->deletion_date = $this->creation_date +
			(int) (24 * 60 * 60 * $this->config['file']['min_age'] +
			(-$this->config['file']['max_age'] + $this->config['file']['min_age']) *
			pow(($this->size / $this->config['file']['max_size'] - 1), 3));
		$fileinfo = new finfo(FILEINFO_MIME_TYPE);
		$this->file_type = $fileinfo->buffer(file_get_contents($_FILES['file']['tmp_name']));
		if (array_key_exists($this->file_type, $this->config["mimesextensions"]))
			$this->name .= "." . $this->config['mimesextensions'][$this->file_type];
		$this->active = true;
		try
		{
			$stmt = $this->Database->prepare("INSERT INTO files (ip, name, size, original_name, creation_date, deletion_date, file_type, active) VALUES (INET_ATON(?), ?, ?, ?, ?, ?, ?, ?)");
			$stmt->execute(array(
				$this->ip,
				$this->name,
				$this->size,
				$this->original_name,
				$this->creation_date,
				$this->deletion_date,
				$this->file_type,
				$this->active
			));
		}
		catch (PDOException $e)
		{
			throw new Exception("File Upload: SQL Request Failed");
		}
		move_uploaded_file($_FILES['file']['tmp_name'], $this->config['uploads_dir'] . "/" . $this->name);
		echo "http://" . $_SERVER['HTTP_HOST'] . "/" . $this->name . "\n";
	}

	public function loadFromDb($name)
	{
		try
		{
			$stmt = $this->Database->prepare("SELECT * FROM files WHERE name = ? AND active = '1' LIMIT 1;");
			$stmt->execute(array($name));
		}
		catch (PDOException $e)
		{
			throw new Exception("Load File: Could not retrieve file");
		}
		$row = $stmt->fetch();
		$this->ip = $row['ip'];
		$this->name = $row['name'];
		$this->size = $row['size'];
		$this->original_name = $row['original_name'];
		$this->creation_date = $row['creation_date'];
		$this->deletion_type = $row['deletion_date'];
		$this->file_type = $row['file_type'];
		$this->active = $row['active'];
	}

	public function display()
	{
		header("Content-Type: " . $this->file_type);
		header("Content-Security-Policy: default-src https:; object-src 'none'");
		echo file_get_contents($this->config['uploads_dir'] . "/" . $this->name);
	}

	private function findUnusedName($name)
	{
		$test_name = $name;
		try
		{
			$stmt = $this->Database->query("SELECT name FROM files WHERE name LIKE '" . $name . "%' AND active = '1';");
			if ($stmt->rowCount() == 0)
				return $name;
			$rows = $stmt->fetchAll();
			$array_len = count($rows);
			$found = true;
			while ($found)
			{
				$found = false;
				$test_name = $name;
				for ($it = 0; $it < $array_len; ++$it)
				{
					$test_name = $name . $it;
					if ($test_name == $rows[$it])
					{
						$found = true;
						break;
					}
				}
			}
		}
		catch (PDOException $e)
		{
			throw $e;
		}
		return $test_name;
	}

	private function shortenName($name)
	{
		$characters = array(
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
			'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
			'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
			'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F',
			'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N',
			'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V',
			'W', 'X', 'Y', 'Z'
		);

		$chars_len = count($characters);
		$hex = sha1(uniqid() . $name . $this->config['urlsalt'], true);
		$shortened = array();
		for ($it = 0; $it < $this->config['shortenedurl_size']; ++$it)
			$shortened[] = $characters[hexdec(bin2hex($hex[$it])) % $chars_len];
		return implode("", $shortened);
	}
}

$File = new File();
$File->setConfig($config);
$File->setDatabase($Database);