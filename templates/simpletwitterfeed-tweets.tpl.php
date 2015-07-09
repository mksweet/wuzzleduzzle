<ul>
<?php foreach ($processed_tweets as $tweet): ?>
<li>
<div class="tweet-text"><?php print $tweet['text']; ?></div>
<a class="tweet-user" href="https://twitter.com/<?php print $tweet['user']; ?>">@<?php print $tweet['user']; ?></a>
<a class="tweet-time_ago" href="<?php print $tweet['url']; ?>"><?php print $tweet['time_ago']; ?></a>
</li>
<?php endforeach; ?>
</ul>

<div class="twitter-more"><a href="https://twitter.com/workdept">More from twitter</a></div>
