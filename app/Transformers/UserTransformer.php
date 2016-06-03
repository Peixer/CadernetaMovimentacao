<?php

namespace Caderneta\Transformers;

use League\Fractal\TransformerAbstract;
use Caderneta\Models\User;

/**
 * Class UserTransformer
 * @package namespace Caderneta\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * Transform the \User entity
     * @param \User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => $model->name,
            'email' => $model->email
        ];
    }
}
