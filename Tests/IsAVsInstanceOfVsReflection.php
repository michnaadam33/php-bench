<?php
/**
 * @todo <Test description here>
 * @file      IsAVsInstanceOfVsReflection.php
 *
 * PHP version 5.6+
 *
 * @author    Adam Michna <alex at itvault dot info>
 * @copyright © 2013-2019 Adam Michna
 * @date      Wed Aug 21 08:36:34 2019
 * @license   The BSD 3-Clause License.
 *            <https://tldrlegal.com/license/bsd-3-clause-license-(revised)>
 */

namespace Tests;

use ReflectionClass;
use Veles\Tools\CliProgressBar;
use Veles\Tools\Timer;
use Application\TestApplication;

/**
 * Class IsAVsInstanceOfVsReflection
 *
 * @author Adam Michna <alex at itvault dot info>
 */
class IsAVsInstanceOfVsReflection extends TestApplication
{
    protected $repeats = 10000;

    public function run()
    {
        $repeats = $this->getRepeats();
        $object = new TestClass;

        $bar = new CliProgressBar($repeats);
        for ($i = 1; $i <= $repeats; ++$i) {
            Timer::start();
            is_a(TestClass::class, TestInterface::class, true);
            Timer::stop();
            $bar->update($i);
        }

        $this->addResult('is_a()', Timer::get());

        Timer::reset();
        $bar = new CliProgressBar($repeats);
        for ($i = 1; $i <= $repeats; ++$i) {
            Timer::start();
            $object instanceof TestInterface;
            Timer::stop();
            $bar->update($i);
        }

        $this->addResult('instanceof', Timer::get());

        Timer::reset();
        $bar = new CliProgressBar($repeats);
        for ($i = 1; $i <= $repeats; ++$i) {
            Timer::start();
            $ref = new ReflectionClass(TestClass::class);
            $ref->implementsInterface(TestInterface::class);
            Timer::stop();
            $bar->update($i);
        }

        $this->addResult('reflection', Timer::get());
    }
}
interface TestInterface
{
    public function foo();
}

class TestClass implements TestInterface
{
    private $private;

    public function foo(){}
}