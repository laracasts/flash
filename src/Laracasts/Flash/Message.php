<?php

namespace Laracasts\Flash;

class Message implements \ArrayAccess
{
    /**
     * The title of the message.
     *
     * @var string
     */
    public $title;

    /**
     * The body of the message.
     *
     * @var string
     */
    public $message;

    /**
     * The message level.
     *
     * @var string
     */
    public $level = 'info';

    /**
     * Whether the message should auto-hide.
     *
     * @var bool
     */
    public $important = false;

    /**
     * Whether the message is an overlay.
     *
     * @var bool
     */
    public $overlay = false;

    /**
     * Create a new message instance.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->update($attributes);
    }

    /**
     * Update the attributes.
     *
     * @param  array $attributes
     * @return $this
     */
    public function update($attributes = [])
    {
        $attributes = array_filter($attributes);

        foreach ($attributes as $key => $attribute) {
            $this->$key = $attribute;
        }

        return $this;
    }


    /**
     * Whether the given offset exists.
     *
     * @param  mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->$offset);
    }

    /**
     * Fetch the offset.
     *
     * @param  mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->$offset;
    }

    /**
     * Assign the offset.
     *
     * @param  mixed $offset
     * @return void
     */
    public function offsetSet(mixed $offset, $value): void
    {
        $this->$offset = $value;
    }

    /**
     * Unset the offset.
     *
     * @param  mixed $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        //
    }
}
