<?php namespace Experience\Article\Tests\App\Helpers;

use Experience\Article\App\Helpers\TemplatePathValidator;
use Experience\Article\Tests\BaseTest;
use org\bovigo\vfs\vfsStream;

class TemplatePathValidatorTest extends BaseTest
{
    /**
     * The mocked file system.
     *
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    protected $root;

    /**
     * The test subject.
     *
     * @var TemplatePathValidator
     */
    protected $subject;

    public function setUp()
    {
        $this->root = vfsStream::setup('templates');
        $this->subject = new TemplatePathValidator($this->root->url());
    }

    public function testAValidPathPassesValidation()
    {
        $validPath = 'valid';
        vfsStream::newDirectory($validPath)->at($this->root);
        $this->assertTrue($this->subject->validatePath($validPath));
    }

    public function testAnInvalidPathFailsValidation()
    {
        $this->assertFalse($this->subject->validatePath('invalid'));
    }
}
