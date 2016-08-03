<?php 
require_once('class_exif.php');

$e = new Exif();

if (isset($_GET['rexif']))
{
	$e->removeExif('elliot.jpg');
}
else
{
	echo '<h1>Add ?rexif to url to remove exif.</h1>';
}

echo '<img src="elliot.jpg">';

echo '<h2>Image Type</h2>';
$imageType = $e->getImageType('elliot.jpg');
if ($imageType != false)
{
	echo $imageType;
}
echo '<h2>All exif values</h2>';
$values = $e->getExifValues('elliot.jpg');
if($values != false)
{
	foreach($values as $key => $value)
	{
		if (is_array($value) == false)
		{
			echo $key.': '.$value.'<br>';
		}
		else
		{
			echo $key.': '; 
			var_dump($value);
			echo '<br>';
		}
	}
}

echo '<h2>Single exif value, for example MimeType</h2>';
$value = $e->getExifValue('elliot.jpg', 'MimeType');
if ($value != false)
{
	echo $value;
}
echo '<h2>Tag name, for example 256</h2>';
$tagName = $e->getExifTagName(256);
if ($tagName != false)
{
	echo $tagName;
}

echo '<h2>Image thumbnail</h2>';
$thumbnail = $e->getExifThumbnail('elliot.jpg');
if ($thumbnail != false)
{
	echo $thumbnail;
}
?>