<?php
declare(strict_types=1);

namespace Fc2blog\Tests\App\Model\BlogsModel;

use BlogsModel;
use Config;
use Fc2blog\Tests\LoaderHelper;
use Model;
use PHPUnit\Framework\TestCase;

class IsCorrectHttpSchemaByBlogArrayTest extends TestCase
{
  public function setUp(): void
  {
    LoaderHelper::requireBootStrap();

    /** @noinspection PhpIncludeInspection */
    require_once(Config::get('MODEL_DIR') . 'model.php');
    if (!class_exists(BlogsModel::class)) {
      Model::load('blogs');
    }

    parent::setUp();
  }

  public function testIsCorrectHttpSchemaByBlogArray(): void
  {
    $_SERVER['HTTPS'] = "on";
    $this->assertFalse(BlogsModel::isCorrectHttpSchemaByBlogArray(['ssl_enable' => Config::get('BLOG.SSL_ENABLE.DISABLE')]));
    unset($_SERVER['HTTPS']);
    $this->assertTrue(BlogsModel::isCorrectHttpSchemaByBlogArray(['ssl_enable' => Config::get('BLOG.SSL_ENABLE.DISABLE')]));

    $_SERVER['HTTPS'] = "on";
    $this->assertTrue(BlogsModel::isCorrectHttpSchemaByBlogArray(['ssl_enable' => Config::get('BLOG.SSL_ENABLE.ENABLE')]));
    unset($_SERVER['HTTPS']);
    $this->assertFalse(BlogsModel::isCorrectHttpSchemaByBlogArray(['ssl_enable' => Config::get('BLOG.SSL_ENABLE.ENABLE')]));
  }
}
