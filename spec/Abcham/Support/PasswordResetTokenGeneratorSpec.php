<?php

namespace spec\Abcham\Support;

use Carbon\Carbon;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class PasswordResetTokenGeneratorSpec
 * @package spec\Abcham\Support
 */
class PasswordResetTokenGeneratorSpec extends ObjectBehavior
{
    function let()
    {
        $type = "alnum";
        $length = 8;
        $this->beConstructedWith($type, $length);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Abcham\Contracts\TokenGenerator');
    }

    function it_generates_a_random_text()
    {
       $this->randomText()->shouldMatch('/^[\w\d]{8}$/');
    }

    function it_allows_to_specify_type_and_length()
    {
        $type = "alpha";
        $length = 16;
        $this->randomText($type, $length)->shouldMatch('/^[\w]{16}$/');
    }

    function it_allows_to_specify_different_types()
    {
        $type = "numeric";
        $this->randomText($type)->shouldMatch('/^[\d]{8}$/');
    }

    function it_generates_tokens()
    {
        $created_at = Carbon::now();
        $valid_until = $created_at->copy()->addDay();
        $this->generate($created_at, $valid_until)->shouldHaveType('Abcham\Contracts\Token');
    }
}
