<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Look
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $image
 * @property string|null $desc
 * @property-read \Illuminate\Database\Eloquent\Collection|Look[] $topics
 * @property-read int|null $topics_count
 * @method static \Illuminate\Database\Eloquent\Builder|Look newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Look newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Look query()
 * @method static \Illuminate\Database\Eloquent\Builder|Look whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Look whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Look whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Look whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Look whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Look whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Look whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Look whereUpdatedAt($value)
 */
	class Look extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Topic
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $desc
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Look[] $looks
 * @property-read int|null $looks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Topic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereUpdatedAt($value)
 */
	class Topic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $topics
 * @property-read int|null $topics_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WardrobeCategory
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $name
 * @property string|null $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WardrobeItem[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|WardrobeCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WardrobeCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WardrobeCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|WardrobeCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WardrobeCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WardrobeCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WardrobeCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WardrobeCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WardrobeCategory whereUpdatedAt($value)
 */
	class WardrobeCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WardrobeItem
 *
 * @property int $wardrobe_item_id
 * @property int $user_id
 * @property-read \App\Models\WardrobeCategory|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|WardrobeItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WardrobeItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WardrobeItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|WardrobeItem whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WardrobeItem whereWardrobeItemId($value)
 */
	class WardrobeItem extends \Eloquent {}
}

