<?php


namespace OpenFram;


class Entity
{
    use Hydrator;
    protected $id;
    protected $errors = [];


    /**
     * Entity constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (isset($data)) {
            $this->hydrate($data);
        }
    }


    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return empty($this->id);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = (int)$id;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

}
