<?php

declare(strict_types=1);

namespace RuneStat\RS3\Skills;

use RuneStat\RS3\Skill;

final class Smithing extends Skill
{
    /**
     * {@inheritdoc}
     */
    protected $id = 14;

    /**
     * {@inheritdoc}
     */
    protected $name = 'smithing';

    /**
     * {@inheritdoc}
     */
    protected $maxExperience = 200000000;

    /**
     * {@inheritdoc}
     */
    protected $maxLevel = 99;

    /**
     * {@inheritdoc}
     */
    protected $maxVirtualLevel = 120;

    /**
     * {@inheritdoc}
     */
    protected $isCombat = false;

    /**
     * {@inheritdoc}
     */
    protected $isMembers = false;

    /**
     * {@inheritdoc}
     */
    protected $isElite = false;
}
