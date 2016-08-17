<?php 
namespace ICMS\Models;

trait MetableTrait {

	/**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (!property_exists($this, 'metafield') || !property_exists($this, 'metadata')) {
        	throw new Exception("Unable to find propery 'metafield' or 'metadata'", 1);
        }

        if (in_array($this->metafield, $this->metadata)) {
        	throw new Exception("'metadata' cannot contain 'metafield' in array.", 1);
        }
    }

    public function setAttribute($key, $value)
    {
    	if (in_array($key, $this->metadata)) {
    		return $this->setMeta($key, $value);
    	}

    	return parent::setAttribute($key, $value);
    }

	public function getAttribute($key)
	{
		if (in_array($key, $this->metadata)) {
			return $this->getMeta($key);
		}

		return parent::getAttribute($key);
	}

	public function getMeta($key)
	{
		$meta = $this->getAttribute($this->metafield);

		if (array_key_exists($key, $meta)) {
			return $meta[$key];
		}

		return null;
	}

	public function setMeta($key, $value)
	{
		$meta = $this->getAttribute($this->metafield);

		$meta[$key] = $value;

		return $this->setAttribute($this->metafield, $meta);
	}
}