<?php

class php2ics
{
	private static string $ics = "";

	public function __construct(string $organisation, string $product)
	{
		$organisation = htmlspecialchars($organisation);
		$product = htmlspecialchars($product);

		$this->Init($organisation,$product);
	}

	//fonction d'initialisation de l'ICS
	private function Init(string $organisation,	?string $product): void
	{
		$organisation = htmlspecialchars($organisation);
		if(isset($product)) {
			$product = htmlspecialchars($product);
		} else {
			$product = "none";
		}

		$this::$ics .= "BEGIN:VCALENDAR\n";
		$this::$ics .= "VERSION:2.0\n";
		$this::$ics .= "PRODID:-//".$organisation."//NONSGML ".$product."\n";
		$this::$ics .= "CALSCALE:GREGORIAN\n";
		$this::$ics .= "METHOD:PUBLISH\n";
	}

	//fonction de création d'évenement
	public function AddEvent(
		string $title,
		?string $description,
		int $begin_date,
		int $end_date,
		?string $location,
		?string $url
	): void
	{
		$title = htmlspecialchars($title);
		$begin_date = htmlspecialchars($begin_date);
		$end_date = htmlspecialchars($end_date);

		$this::$ics .= "BEGIN:VEVENT\n";
		$this::$ics .= "SUMMARY:".$title."\n";
		$this::$ics .= "DTSTART:".date('Ymd',$begin_date)."T".date('His',$begin_date)."\n";
		$this::$ics .= "DTEND:".date('Ymd',$end_date)."T".date('His',$end_date)."\n";
		if(isset($location)) {
			$location = htmlspecialchars($location);
			$this::$ics .= "LOCATION:".$location."\n";
		}
		if(isset($description)) {
			$description = htmlspecialchars($description);
			$this::$ics .= "DESCRIPTION:".$description."\n";
		}
		if(isset($url)) {
			$url = htmlspecialchars($url);
			$this::$ics .= "URL:".$url."\n";
		}
		$this::$ics .= "END:VEVENT\n";
	}

	//fonction de fin d'ICS
	public function End(): void
	{
		$this::$ics .= "END:VCALENDAR";
	}

	//fonction qui permet de récupérer le code ICS
	public function GetICS(): string
	{
		$getICS = $this::$ics;
		return $getICS = str_replace("\n", "<br>", $getICS);
	}

	//fonction qui permet de télécharger le fichier ICS
	public function DownloadICS(?string $fichier): void
	{
		if(!isset($fichier)) {
			$fichier = 'calend.ics';
		}

		$dwn = str_replace("<br>","\n", $this::$ics);
		$f = fopen($fichier, 'w+');
		fputs($f, $this::$ics);
		header('Location:'.$fichier);
	    exit;
	}
}

?>