<?php

/**
 * Created by PhpStorm.
 * User: mlaine
 * Date: 14/06/16
 * Time: 09:46
 */
class Test
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $name;

    /**
     * @Column(type="string")
     */
    private $lastName;

    /**
     * @Column(type="string")
     */
    private $email;
}