<?php 

class Exif 
{
	
	public function getImageType ($i) // $i - image path
	{
		if (!isset($i))
		{
			return false;
		}
		if (is_string($i) == false)
		{
			return false;
		}
		$type = exif_imagetype($i);
		if ($type == false)
		{
			return false;
		}
		 return $type;
	}
	
	public function getExifValues ($i, $sections = NULL, $arrays = false, $thumbnail = false)
	{
		if (!isset($i))
		{
			return false;
		}
		if (is_string($i) == false)
		{
			return false;
		}
		if ($sections != NULL)
		{
			if (is_string($sections) == false)
			{
				return false;
			}
		}
		if ($arrays != false)
		{
			if (is_array($arrays) == false)
			{
				return false;
			}
		}
		$data = exif_read_data($i, $sections, $arrays, $thumbnail);
		if ($data == false)
		{
			return false;
		}
		return $data;
	}
	
	public function getExifValue ($i, $key)
	{
		if (!isset($i) || !isset($key))
		{
			return false;
		}
		if (is_string($i) == false || is_string($key) == false)
		{
			return false;
		}
		$values = exif_read_data($i);
		if ($values == false)
		{
			return false;
		}
		if (!isset($values[$key]))
		{
			return false;
		}
		return $values[$key];
	}
	
	public function getExifTagName ($index)
	{
		if (is_numeric($index) == false)
		{
			return false;
		}
		$tagName = exif_tagname($index);
		if ($tagName == false)
		{
			return false;
		}
		return $tagName;
	}
	
	public function getExifThumbnail ($i, $width = null, $height = null, $imagetype = null)
	{
		if (!isset($i))
		{
			return false;
		}
		if (is_string($i) == false)
		{
			return false;
		}
		$thumbnail = exif_thumbnail($i, $width, $height, $imagetype);
		if ($thumbnail == false)
		{
			return false;
		}
		return $thumbnail;
	}
	
	public function removeExif ($i)
	{
		if (!isset($i))
		{
			return false;
		}
		if (is_string($i) == false)
		{
			return false;
		}
		if (is_file($i) == false)
		{
			return false;
		}
		// check if gd is installed
		if (null !== gd_info())
		{
			if (is_array(gd_info()))
			{
				// remove exif recreating the image
				$ext = pathinfo($i, PATHINFO_EXTENSION);
				if ($ext == 'jpg' || $ext == 'jpeg')
				{
					$img = imagecreatefromjpeg($i);
					imagejpeg($img,$i,100);
				}
				else
				{
					return true; // done! 
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	
}