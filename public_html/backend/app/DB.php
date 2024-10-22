<?php
/*CLASS Database*/
class Database
{

	private $host;
	private $user;
	private $pass;
	private $name;
	private $link;
	private $error;
	private $errno;
	private $query;

	function __construct($host, $user, $pass, $name)
	{
		if (!empty($host) && !empty($user) && !empty($pass) && !empty($name)) {
			$this->host = $host;
			$this->user = $user;
			$this->pass = $pass;
			$this->name = $name;
			$conn = 1;
		} else {
			$conn = 0;
		}
		if ($conn == 1) {
			$this->connect();
		}
	}

	function __destruct()
	{
		if (!empty($this->link)) {
			@mysqli_close($this->link);
		}
	}

	public function set_char_utf8($db)
	{
		if (!empty($db)) {
			$cs1 = "SET character_set_results=utf8";
			$cs2 = "SET character_set_client = utf8";
			$cs3 = "SET character_set_connection = utf8";
			@mysqli_query($this->link, $cs1) or die('Error query: ' . $this->link->error);
			@mysqli_query($this->link, $cs2) or die('Error query: ' . $this->link->error);
			@mysqli_query($this->link, $cs3) or die('Error query: ' . $this->link->error);
		}
	}

	public function connect()
	{
		if ($this->link = mysqli_connect($this->host, $this->user, $this->pass, $this->name)) {
			if (empty($this->link)) {
				$this->exception("Could not connect to the database!");
			}
		} else {
			$this->exception("Could not create database connection!");
		}
	}

	public function close()
	{
		@mysqli_close($this->link);
	}

	public function query($sql)
	{
		if ($this->query = @mysqli_query($this->link, $sql)) {
			$this->set_char_utf8($this->name);
			return $this->query;
		} else {
			$this->exception("Could not query database!");
			return false;
		}
	}
	public function query_last_id($sql)
	{
		if (mysqli_query($this->link, $sql)) {
			$id = $this->link->insert_id;
			return $id;
		} else {
			$this->exception("Could not query database!");
			return false;
		}
	}

	public function num_rows($qid)
	{
		if (empty($qid)) {
			$this->exception("Could not get number of rows because no query id was supplied!");
			return false;
		} else {
			return @mysqli_num_rows($qid);
		}
	}

	public function fetch_array($qid)
	{
		if (empty($qid)) {
			$this->exception("Could not fetch array because no query id was supplied!");
			return false;
		} else {
			$data = mysqli_fetch_array($qid);
		}
		return $data;
	}

	public function fetch_array_assoc($qid)
	{
		if (empty($qid)) {
			$this->exception("Could not fetch array assoc because no query id was supplied!");
			return false;
		} else {
			$data = mysqli_fetch_array($qid, MYSQLI_ASSOC);
		}
		return $data;
	}

	public function fetch_all_array($sql, $assoc = true)
	{
		$data = array();
		if ($qid = $this->query($sql)) {
			if ($assoc) {
				while ($row = $this->fetch_array_assoc($qid)) {
					$data[] = $row;
				}
			} else {
				while ($row = $this->fetch_array($qid)) {
					$data[] = $row;
				}
			}
		} else {
			return false;
		}
		return $data;
	}

	public function last_id()
	{
		if ($id = $this->link->insert_id()) {
			return $id;
		} else {
			return false;
		}
	}

	private function exception($message)
	{
		if ($this->link) {
			$this->error = $this->link->error;
			$this->errno = $this->link->errno;
		} else {
			$this->error = $this->link->error;
			$this->errno = $this->link->errno;
		}
		if (PHP_SAPI !== 'cli') {
			echo "Database Error\n";
		} else {
			echo "MYSQL ERROR: " . ((isset($this->error) && !empty($this->error)) ? $this->error : '') . "\n";
		};
	}
}
