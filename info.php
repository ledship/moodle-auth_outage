<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * List outages
 *
 * @package    auth_outage
 * @author     Daniel Thee Roperto <daniel.roperto@catalyst-au.net>
 * @copyright  Catalyst IT
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use auth_outage\outagedb;
use auth_outage\outagelib;

require_once('../../config.php');

$outage = outagedb::get_active();
if (is_null($outage)) {
    redirect(new moodle_url('/'));
}

$PAGE->set_context(context_system::instance());
$PAGE->set_title("Outage Warning");
$PAGE->set_heading("Outage Warning");
$PAGE->set_url(new \moodle_url('/auth/outage/info.php'));

$mform = new \auth_outage\forms\gohome();
if ($mform->get_data()) {
    redirect(new moodle_url('/'));
}


echo $OUTPUT->header();

echo outagelib::get_renderer()->renderoutagepage($outage);
$mform->display();

echo $OUTPUT->footer();
