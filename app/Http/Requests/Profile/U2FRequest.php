<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\AbstractEmptyRequest;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 * @mixin Request
 */
class U2FRequest extends AbstractEmptyRequest
{
	/**
	 * {@inheritDoc}
	 */
	public function authorize(): bool
	{
		return Gate::check(UserPolicy::CAN_EDIT, [User::class]);
	}
}
