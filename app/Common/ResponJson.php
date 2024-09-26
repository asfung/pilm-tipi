<?php
namespace App\Common;

use Symfony\Component\HttpFoundation\Response;

class ResponJson 
{
    private $code;
    private $message;
    private $data;
    private $errors;
    private $filterData;

    /**
     * ResponseCreatorPresentationLayer constructor.
     * @param $code
     * @param $message
     * @param $data
     */
    public function __construct($code, $message, $data, $errors, $filterData = array())
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
        $this->filterData = $filterData;
        $this->errors = $errors;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param mixed $errors
     */
    public function setErrors($errors): void
    {
        $this->errors = $errors;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getFilterData()
    {
        return $this->filterData;
    }

    /**
     * @param mixed $filterData
     */
    public function setFilterData($filterData): void
    {
        $this->filterData = $filterData;
    }

    

    public function getResponse()
    {
        $out = [
            'code' => $this->code,
            'message' => $this->message,
            'data' => $this->data,
            'errors' => $this->errors
        ];

        if(is_array($this->filterData) && count($this->filterData) > 0){
            $out["filter_data"] = $this->filterData;
        }
        return $out;
        // return response()->json($out, $this->code);
        // return response()->json($out)->status($this->code);

    }
}
