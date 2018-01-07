<?php

class Assistance
{

    private $idassist;
    private $iduserAct;
    private $iduser;
    private $idactivity;
    private $date;
    private $assist;

    /**
     * Assistance constructor.
     * @param $idassist
     * @param $iduser
     * @param $idactivity
     * @param $date
     * @param $assist
     */
    public function __construct($idassist=null,$iduserAct=null, $iduser=null, $idactivity=null, $date=null, $assist=null)
    {
        $this->idassist = $idassist;
        $this->iduserAct = $iduserAct;
        $this->iduser = $iduser;
        $this->idactivity = $idactivity;
        $this->date = $date;
        $this->assist = $assist;
    }

    /**
     * @return mixed
     */
    public function getIdassist()
    {
        return $this->idassist;
    }

    /**
     * @param mixed $idassist
     */
    public function setIdassist($idassist)
    {
        $this->idassist = $idassist;
    }

    /**
     * @return mixed
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param mixed $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    /**
     * @return mixed
     */
    public function getIdactivity()
    {
        return $this->idactivity;
    }

    /**
     * @param mixed $idactivity
     */
    public function setIdactivity($idactivity)
    {
        $this->idactivity = $idactivity;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getAssist()
    {
        return $this->assist;
    }

    /**
     * @param mixed $assist
     */
    public function setAssist($assist)
    {
        $this->assist = $assist;
    }

    /**
     * @return mixed
     */
    public function getIduserAct()
    {
        return $this->iduserAct;
    }

    /**
     * @param mixed $iduserAct
     */
    public function setIduserAct($iduserAct)
    {
        $this->iduserAct = $iduserAct;
    }




}