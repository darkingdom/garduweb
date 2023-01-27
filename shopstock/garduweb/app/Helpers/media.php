<?php
class Media
{
    static public function uploadImage($data, $categories = '')
    {

        // ===== New Size ===== //
        if ($categories == 'avatar') {
            $newSize    = 300;
            $newThumb   = 150;
            $newIcon    = 50;
            $prefixName = 'AVT-';
        } elseif ($categories == 'logo') {
            $newSize    = 500;
            $newThumb   = 200;
            $newIcon    = 80;
            $prefixName = 'LOGO-';
        } else {
            $newSize    = 800;
            $newThumb   = 200;
            $newIcon    = 80;
            $prefixName = '';
        }

        $image = $data['file']['name'];
        $tmpImage = $data['file']['tmp_name'];

        $date = date('Ymd');
        $temp = explode(".", $image);
        $extension = end($temp);
        $microtime = round(microtime(true));
        $newFileName = $prefixName . md5($date . $microtime) . '.' . $extension;

        $dir            = "garduweb/storage/upload/images";
        $dir_thumb      = $dir . "/thumb";
        $dir_icon       = $dir . "/icon";

        $allowExtension = array('jpg', 'jpeg', 'png');

        if (in_array($extension, $allowExtension) === TRUE) {

            if ($extension == "jpg" || $extension == "jpeg") {
                $src     = imagecreatefromjpeg($tmpImage);
            } else if ($extension == "png") {
                $src     = imagecreatefrompng($tmpImage);
            }

            $src_width = imageSX($src);
            $src_height = imageSY($src);

            if ($src_width > $src_height) {
                if ($src_width > $newSize) {
                    $newWidth           = $newSize;
                    $newHeight          = ($src_height / $src_width) * $newSize;
                } else {
                    $newWidth           = $src_width;
                    $newHeight          = $src_height;
                }

                if ($src_width > $newThumb) {
                    $newWidthThumb      = $newThumb;
                    $newHeightThumb     = ($src_height / $src_width) * $newThumb;
                } else {
                    $newWidthThumb      = $src_width;
                    $newHeightThumb     = $src_height;
                }

                if ($src_width > $newIcon) {
                    $newWidthIcon       = $newIcon;
                    $newHeightIcon      = ($src_height / $src_width) * $newIcon;
                } else {
                    $newWidthIcon       = $src_width;
                    $newHeightIcon      = $src_height;
                }
            } else if ($src_width < $src_height) {
                if ($src_height > $newSize) {
                    $newHeight          = $newSize;
                    $newWidth           = ($src_width / $src_height) * $newHeight;
                } else {
                    $newWidth           = $src_width;
                    $newHeight          = $src_height;
                }

                if ($src_height > $newThumb) {
                    $newHeightThumb     = $newThumb;
                    $newWidthThumb      = ($src_width / $src_height) * $newThumb;
                } else {
                    $newWidthThumb      = $src_width;
                    $newHeightThumb     = $src_height;
                }

                if ($src_height > $newIcon) {
                    $newHeightIcon      = $newIcon;
                    $newWidthIcon       = ($src_width / $src_height) * $newIcon;
                } else {
                    $newWidthIcon       = $src_width;
                    $newHeightIcon      = $src_height;
                }
            } else {
                if ($src_height > $newSize) {
                    $newWidth           = $newSize;
                    $newHeight          = $newSize;
                } else {
                    $newWidth           = $src_width;
                    $newHeight          = $src_height;
                }

                if ($src_height > $newThumb) {
                    $newHeightThumb     = $newThumb;
                    $newWidthThumb      = $newThumb;
                } else {
                    $newWidthThumb      = $src_width;
                    $newHeightThumb     = $src_height;
                }

                if ($src_height > $newIcon) {
                    $newHeightIcon      = $newIcon;
                    $newWidthIcon       = $newIcon;
                } else {
                    $newWidthIcon       = $src_width;
                    $newHeightIcon      = $src_height;
                }
            }



            //proses perubahan ukuran
            $new_image1 = imagecreatetruecolor($newWidth, $newHeight);
            $new_image2 = imagecreatetruecolor($newWidthThumb, $newHeightThumb);
            $new_image3 = imagecreatetruecolor($newWidthIcon, $newHeightIcon);
            imagecopyresampled($new_image1, $src, 0, 0, 0, 0, $newWidth, $newHeight, $src_width, $src_height);
            imagecopyresampled($new_image2, $src, 0, 0, 0, 0, $newWidthThumb, $newHeightThumb, $src_width, $src_height);
            imagecopyresampled($new_image3, $src, 0, 0, 0, 0, $newWidthIcon, $newHeightIcon, $src_width, $src_height);

            $filename1     = $dir . "/" . $newFileName;
            $filename2     = $dir_thumb . "/" . $newFileName;
            $filename3     = $dir_icon . "/" . $newFileName;

            //Simpan gambar
            imagejpeg($new_image1, $filename1, 100);
            imagejpeg($new_image2, $filename2, 100);
            imagejpeg($new_image3, $filename3, 100);

            //Hapus gambar di memori komputer
            imagedestroy($src);
            imagedestroy($new_image1);
            imagedestroy($new_image2);
            imagedestroy($new_image3);

            return $newFileName;
        } else {
            return 'failed';
        }
    }

    static public function uploadImageSingle()
    {
    }

    static public function uploadAvatar($data)
    {
    }

    static public function deleteImage($data)
    {
        if (!empty($data)) :
            unlink('garduweb/storage/upload/images/' . $data);
            unlink('garduweb/storage/upload/images/thumb/' . $data);
            unlink('garduweb/storage/upload/images/icon/' . $data);
            return 1;
        else :
            return 0;
        endif;
    }
}
