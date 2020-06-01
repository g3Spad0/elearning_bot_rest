<?php


class Configs
{
    private static $limit = [20, 50, 100];

    public static function isCurrentLimit(int $limit) {
        return in_array($limit, Configs::$limit);
    }

    public static function getDefaultLimit() {
        return Configs::$limit[0];
    }
}