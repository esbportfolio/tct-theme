<?php
/**
 * The template for displaying pagination
 * 
 * This should always be called inside a conditional statement, since the pagination section
 * shouldn't be created if it isn't necessary.  Variables in this file should be scoped
 * to that conditional and should *not* be global.
 */

declare(strict_types=1);

?>

                <nav class="pagination" aria-label="Page Navigation">
                    <ul>
<?php
$pagination_formatter = new Tct_Pagination_Formatter($wp_query, new Tct_Html_Helper());
echo $pagination_formatter->format_links(6);
?>
                    </ul>
                </nav>