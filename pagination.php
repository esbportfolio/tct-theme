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

                <nav aria-label="Page Navigation">
                    <ul class="pagination">
<?php
// $pagination_formatter = new Tct_Pagination_Formatter($wp_query, new Tct_Html_Helper());
// echo $pagination_formatter->format_links(8);
?>
                    </ul>
                </nav>
                <nav class="pagination" aria-label="Demo Page Navigation">
                    <ul>
                        <li class="prev disabled" aria-disabled="true"><span class="icon-left-dir"></span>Prev</li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li class="gap">...</li>
                        <li><a href="#">10</a></li>
                        <li class="next">Next<span class="icon-right-dir"></li>
                    </ul>
                </nav>