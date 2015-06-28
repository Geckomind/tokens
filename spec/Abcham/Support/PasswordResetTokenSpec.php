<?php

namespace spec\Abcham\Support;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Carbon\Carbon;

/**
 * Class PasswordResetTokenSpec
 * @package spec\Abcham\Support
 */
class PasswordResetTokenSpec extends ObjectBehavior
{
    function let()
    {
        $created_at = Carbon::now();
        $valid_until = $created_at->copy()->addDay();
        $token = "123457";
        $user_id = 0; //Opcional
        $this->beConstructedWith($token, $created_at, $valid_until, $user_id);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('Abcham\Contracts\Token');
    }

    function it_returns_the_token()
    {
        $created_at = Carbon::now();
        $valid_until = $created_at->copy()->addDay();
        $token = "12345";
        $this->beConstructedWith($token, $created_at, $valid_until);
        $this->token()->shouldReturn("12345");
    }

    function it_returns_the_created_at_date()
    {
        $created_at = Carbon::now();
        $valid_until = $created_at->copy()->addDay();
        $token = "123457";
        $this->beConstructedWith($token, $created_at, $valid_until);
        $this->createdAt()->shouldReturn($created_at);
    }

    function it_returns_the_valid_until_date()
    {
        $created_at = Carbon::now();
        $valid_until = $created_at->copy()->addDay();
        $token = "123457";
        $this->beConstructedWith($token, $created_at, $valid_until);
        $this->validUntil()->shouldReturn($valid_until);
    }

    function it_returns_the_token_user_id()
    {
        $this->userId()->shouldBe(0);
    }

    function it_allows_to_set_the_user_id()
    {
        $user_id = 1;
        $this->userId($user_id)->shouldBe(1);
    }
}
