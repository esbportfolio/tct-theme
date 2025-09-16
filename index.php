<?php
/**
 * The main template file
 *
 * This acts as a fallback if no other templates are used.  It is also specifically used for the main blog page.
 */

declare(strict_types=1);

get_header();

?>
            <div>
                <h1>I'm a header</h1>
                <p>I'm body text</p>
                <ul>
                    <li>List item 1</li>
                    <li>List item 2</li>
                </ul>
            </div>
<?php

get_footer();