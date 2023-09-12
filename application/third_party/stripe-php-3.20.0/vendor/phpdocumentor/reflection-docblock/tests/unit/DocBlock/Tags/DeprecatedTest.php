<?php
/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2010-2015 Mike van Riel<mike@phpdoc.org>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Reflection\DocBlock\Tags;

use Mockery as m;
use phpDocumentor\Reflection\DocBlock\Description;
use phpDocumentor\Reflection\DocBlock\DescriptionFactory;
use phpDocumentor\Reflection\Types\Context;

/**
 * @coversDefaultClass \phpDocumentor\Reflection\DocBlock\Tags\Deprecated
 * @covers ::<private>
 */
class DeprecatedTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @uses   \phpDocumentor\Reflection\DocBlock\Tags\Deprecated::__construct
     * @uses   \phpDocumentor\Reflection\DocBlock\Description
     * @covers \phpDocumentor\Reflection\DocBlock\Tags\BaseTag::getName
     */
    public function testIfCorrectTagNameIsReturned()
    {
        $fixture = new Deprecated('1.0', new Description('Description'));

        $this->assertSame('deprecated', $fixture->getName());
    }

    /**
     * @uses   \phpDocumentor\Reflection\DocBlock\Tags\Deprecated::__construct
     * @uses   \phpDocumentor\Reflection\DocBlock\Tags\Deprecated::__toString
     * @uses   \phpDocumentor\Reflection\DocBlock\Tags\Formatter\PassthroughFormatter
     * @uses   \phpDocumentor\Reflection\DocBlock\Description
     * @covers \phpDocumentor\Reflection\DocBlock\Tags\BaseTag::render
     * @covers \phpDocumentor\Reflection\DocBlock\Tags\BaseTag::getName
     */
    public function testIfTagCanBeRenderedUsingDefaultFormatter()
    {
        $fixture = new Deprecated('1.0', new Description('Description'));

        $this->assertSame('@deprecated 1.0 Description', $fixture->render());
    }

    /**
     * @uses   \phpDocumentor\Reflection\DocBlock\Tags\Deprecated::__construct
     * @uses   \phpDocumentor\Reflection\DocBlock\Description
     * @covers \phpDocumentor\Reflection\DocBlock\Tags\BaseTag::render
     */
    public function testIfTagCanBeRenderedUsingSpecificFormatter()
    {
        $fixture = new Deprecated('1.0', new Description('Description'));

        $formatter = m::mock(Formatter::class);
        $formatter->shouldReceive('format')->with($fixture)->andReturn('Rendered output');

        $this->assertSame('Rendered output', $fixture->render($formatter));
    }

    /**
     * @covers ::__construct
     * @covers ::getVersion
     */
    public function testHasVersionNumber()
    {
        $expected = '1.0';

        $fixture = new Deprecated($expected);

        $this->assertSame($expected, $fixture->getVersion());
    }

    /**
     * @covers ::__construct
     * @covers \phpDocumentor\Reflection\DocBlock\Tags\BaseTag::getDescription
     * @uses   \phpDocumentor\Reflection\DocBlock\Description
     */
    public function testHasDescription()
    {
        $expected = new Description('Description');

        $fixture = new Deprecated('1.0', $expected);

        $this->assertSame($expected, $fixture->getDescription());
    }

    /**
     * @covers ::__construct
     * @covers ::__toString
     * @uses   \phpDocumentor\Reflection\DocBlock\Description
     */
    public function testStringRepresentationIsReturned()
    {
        $fixture = new Deprecated('1.0', new Description('Description'));

        $this->assertSame('1.0 Description', (string)$fixture);
    }

    /**
     * @covers ::create
     * @uses \phpDocumentor\Reflection\DocBlock\Tags\Deprecated::<public>
     * @uses \phpDocumentor\Reflection\DocBlock\DescriptionFactory
     * @uses \phpDocumentor\Reflection\DocBlock\Description
     * @uses \phpDocumentor\Reflection\Types\Context
     */
    public function testFactoryMethod()
    {
        $descriptionFactory = m::mock(DescriptionFactory::class);
        $context = new Context('');

        $version = '1.0';
        $description = new Description('My Description');

        $descriptionFactory->shouldReceive('create')->with('My Description', $context)->andReturn($description);

        $fixture = Deprecated::create('1.0 My Description', $descriptionFactory, $context);

        $this->assertSame('1.0 My Description', (string)$fixture);
        $this->assertSame($version, $fixture->getVersion());
        $this->assertSame($description, $fixture->getDescription());
    }

    /**
     * @covers ::create
     * @uses \phpDocumentor\Reflection\DocBlock\Tags\Deprecated::<public>
     * @uses \phpDocumentor\Reflection\DocBlock\DescriptionFactory
     * @uses \phpDocumentor\Reflection\DocBlock\Description
     * @uses \phpDocumentor\Reflection\Types\Context
     */
    public function testFactoryMethodCreatesEmptyDeprecatedTag()
    {
        $descriptionFactory = m::mock(DescriptionFactory::class);
        $descriptionFactory->shouldReceive('create')->never();

        $fixture = Deprecated::create('', $descriptionFactory, new Context(''));

        $this->assertSame('', (string)$fixture);
        $this->assertSame(null, $fixture->getVersion());
        $this->assertSame(null, $fixture->getDescription());
    }

    /**
     * @covers ::create
     * @expectedException \InvalidArgumentException
     */
    public function testFactoryMethodFailsIfVersionIsNotString()
    {
        $this->assertNull(Deprecated::create([]));
    }

    /**
     * @covers ::create
     */
    public function testFactoryMethodReturnsNullIfBodyDoesNotMatchRegex()
    {
        $this->assertNull(Deprecated::create('dkhf<'));
    }
}
