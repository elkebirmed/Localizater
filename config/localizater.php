<?php

return [
    /**
     * Available locales.
     *
     * 'locales' => [
     *     'en' => 'English',
     *     'fr' => 'Français',
     *     'ar' => 'العربية',
     * ],
     */
    'locales' => [
        'en' => 'English',
    ],

    /**
     * RTL Locales.
     *
     * Locales listed here will have special layout direction.
     */
    'rtl_locales' => ['ar'],

    /**
     * Prefix default locale or not.
     *
     * true:
     * example.com/en
     * example.com/fr
     *
     * false:
     * example.com
     * example.com/fr
     */
    'prefix_default' => false,

    /**
     * Prefix default locale route name or not.
     *
     * true: ->name('page')
     * +----------+----------+---------+
     * | Method   | URI      | Name    |
     * +----------+----------+---------+
     * | GET|HEAD | /page    | en.page |
     * +----------+----------+---------+
     * | GET|HEAD | /fr/page | fr.page |
     * +----------+----------+---------+
     *
     * false: ->name('page')
     * +----------+----------+---------+
     * | Method   | URI      | Name    |
     * +----------+----------+---------+
     * | GET|HEAD | /page    | page    |
     * +----------+----------+---------+
     * | GET|HEAD | /fr/page | fr.page |
     * +----------+----------+---------+
     */
    'prefix_default_name' => false,
];
