<?php

namespace src\controller\pages;

use src\model\userImage;

class navbarUserArea
{

  public static function getUser()
  {

    echo userImage::getImage();

  }
}