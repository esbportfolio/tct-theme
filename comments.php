<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 * 
 * This should always be called inside a conditional statement, since the comments section
 * shouldn't be created if there are no comments.  Variables in this file should be scoped
 * to that conditional and should *not* be global.
 */

declare(strict_types=1);

// Retrieve comment count for the current post
$comment_count = get_comments_number(get_the_id());
$comment_text = $comment_count . ( (intval($comment_count) === 1) ? ' response' : ' responses' ) . ' on “' . get_the_title() . '”';

?>
                <div class="comments">
                    <h4>Comments</h4>
                    <p><?php echo $comment_text; ?></p>
                    <div id="comments-content">
                        <div class="comment">
                            <div class="author">Comment Author</div>
                            <div class="date">October 3, 2024 at 5:27 AM</div>
                            <div class="body"><p>Curabitur et venenatis libero, non porttitor massa. Phasellus scelerisque quam in faucibus cursus. Aliquam rutrum leo at sagittis euismod. Vivamus tristique mauris tellus, ac varius ipsum commodo eu. Nunc placerat tortor a leo placerat, at eleifend lorem consequat. Phasellus dapibus leo in faucibus vehicula. Proin condimentum orci sit amet rutrum maximus. Suspendisse sit amet erat tempor, pulvinar leo eu, ullamcorper mauris.</p></div>
                            <div class="reply"><a href="#">Reply</a></div>

                            <div class="comment thread">
                                <div class="author">Comment Author</div>
                                <div class="date">October 3, 2024 at 5:27 AM</div>
                                <div class="body"><p>Suspendisse in diam tempus, eleifend ipsum eget, hendrerit quam. Nulla eget augue ornare, imperdiet mauris non, hendrerit nulla. Sed sit amet nisi aliquet, varius est id, volutpat lacus. Mauris non ligula congue, dignissim ligula id, commodo orci. Donec rutrum vel ante et tristique. Praesent imperdiet lobortis neque sed sollicitudin. Curabitur vitae fringilla nibh. Sed ornare nulla tincidunt bibendum lobortis. Etiam blandit est velit, vitae iaculis odio tristique id. Sed sagittis mattis mauris non efficitur. Aenean convallis auctor risus sed dignissim. Phasellus ullamcorper maximus ex a efficitur.</p>
                                <p>Sed mollis egestas nulla, at mollis tellus commodo convallis. Aliquam interdum facilisis magna, consequat molestie dui lacinia pulvinar. Vestibulum tempor sagittis neque sit amet pretium. Donec eu risus tincidunt, facilisis neque vitae, porta quam. In eget arcu accumsan, commodo diam in, fringilla neque. Aenean at est ac libero pellentesque facilisis vitae ac lacus. In quis metus ut purus semper elementum. Etiam facilisis eros at sem feugiat, eget elementum felis congue. Aenean in libero justo. Cras ante leo, maximus id massa elementum, ullamcorper hendrerit turpis.</p></div>
                                <div class="reply"><a href="#">Reply</a></div>
                            
                                <div class="comment">
                                    <div class="author">Comment Author</div>
                                    <div class="date">October 3, 2024 at 5:27 AM</div>
                                    <div class="body"><p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Quisque malesuada magna vel libero laoreet, id vestibulum est iaculis. Etiam vel est at purus cursus rutrum. Mauris viverra tellus id est tincidunt rutrum. Nam vel nunc rutrum, cursus augue a, scelerisque nibh. Donec luctus sodales enim, sed pellentesque turpis pulvinar a. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis lacinia ex at nisi viverra faucibus. Phasellus id metus justo. Vestibulum et odio ut urna rutrum varius. Donec convallis sapien et ligula interdum, in dictum nisl aliquam.</p></div>
                                    <div class="reply"><a href="#">Reply</a></div>
                                </div>
                            
                            </div>

                        </div>

                        <div class="comment">
                            <div class="author">Comment Author</div>
                            <div class="date">October 3, 2024 at 5:27 AM</div>
                            <div class="body"><p>Mauris hendrerit dui nec tellus varius, at convallis lectus tincidunt. Phasellus fermentum, mauris vitae bibendum euismod, justo ante malesuada enim, id aliquet nunc sem at urna. Praesent consequat nunc sit amet auctor dapibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam efficitur dignissim imperdiet. Nam maximus auctor lectus. Proin luctus laoreet ligula vel posuere. Morbi viverra velit pulvinar ante accumsan suscipit. Curabitur cursus tellus ac diam luctus lobortis. Curabitur ultrices lectus ac ligula sollicitudin, et blandit nunc finibus. Vestibulum tempor dignissim elit, eu pulvinar massa. Morbi vel lectus tincidunt, faucibus odio in, volutpat nunc. Sed quis justo metus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p></div>
                            <div class="reply"><a href="#">Reply</a></div>
                        </div>
                    </div>
                </div>
