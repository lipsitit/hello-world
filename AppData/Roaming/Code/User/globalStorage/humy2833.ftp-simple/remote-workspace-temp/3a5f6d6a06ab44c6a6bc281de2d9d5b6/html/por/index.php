<?php
error_reporting(E_ALL); ini_set("display_errors", 1);

$ip = $_SERVER['REMOTE_ADDR'];
$data_file = 'data.json';
$comment_file = 'comments.json';
$now = time();
$wait_time = 180; // 3분

$data = file_exists($data_file) ? json_decode(file_get_contents($data_file), true) : array();
$can_vote = !isset($data[$ip]) || ($now - $data[$ip]) > $wait_time;
$remaining = isset($data[$ip]) ? $wait_time - ($now - $data[$ip]) : 0;

$total_votes = count($data);
$recent_ips = array_slice(array_keys($data), -20);

$comments = file_exists($comment_file) ? json_decode(file_get_contents($comment_file), true) : array();
$recent_comments = array_slice(array_reverse($comments), 0, 30);

function mask_ip($ip) {
    $parts = explode('.', $ip);
    return $parts[0] . '.' . $parts[1] . '.*.*';
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8159090037843542"
     crossorigin="anonymous"></script>
  <meta charset="UTF-8">
  <title>포르노 합법화 찬성 | 표현의 자유를 위한 투표</title>
  <meta name="description" content="포르노 합법화에 찬성해주세요. 표현의 자유, 성교육 자료, 성범죄 예방 등을 위한 사회적 합의를 위한 투표 페이지입니다.">
  <meta name="keywords" content="포르노, 합법화, 성인물, 표현의 자유, 투표, 성범죄 예방">
  <meta property="og:title" content="포르노 합법화 찬성 투표 페이지">
  <meta property="og:description" content="표현의 자유를 위한 찬성 투표에 함께 해주세요. 댓글도 남길 수 있습니다.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://example.com/vote_porno">
  <meta property="og:image" content="https://example.com/og-image.jpg">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
  <style>
    .container { max-width: 700px; margin-top: 50px; }
    .voted-msg { margin-top: 20px; color: darkred; }
    .section { margin-top: 40px; }
    textarea { resize: none; }
  </style>
</head>
<body>
<div class="container">
  <h1 class="text-center">포르노 합법화 찬성 투표</h1>
  <p class="text-center">3분마다 한 번씩 찬성할 수 있습니다. 댓글도 남겨보세요!</p>

  <div class="text-center">
    <?php if ($can_vote): ?>
      <form method="post" action="vote.php"><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8159090037843542"
     crossorigin="anonymous"></script>
<!-- ewfefw -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8159090037843542"
     data-ad-slot="6328010711"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

        <button class="btn btn-danger btn-lg">포르노 합법화 찬성!</button>
      </form>
    <?php else: ?>
      <div class="voted-msg">
        이미 투표하셨습니다. <?= $remaining ?>초 뒤에 다시 투표하실 수 있습니다.
      </div>
    <?php endif; ?>
  </div>

  <div class="section">
    <h2>총 찬성자 수: <?= $total_votes ?>명</h2>
  </div>

  <div class="section">
    <h3>최근 찬성자 IP 일부</h3>
    <ul>
      <?php foreach ($recent_ips as $recent_ip): ?>
        <li><?= mask_ip($recent_ip) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="section">
    <h3>왜 포르노 합법화가 필요한가요?</h3>
    <ul>
      <li>표현의 자유 보장</li>
      <li>음지 산업 양성화로 성범죄 예방</li>
      <li>콘텐츠 산업 활성화</li>
      <li>올바른 성교육 자료 확보</li>
    </ul>
  </div>

  <div class="section">
    <h3>익명 의견 남기기</h3>
    <form method="post" action="comment.php">
      <div class="form-group">
        <textarea class="form-control" name="comment" rows="2" maxlength="100" placeholder="100자 이내로 의견을 남겨주세요" required></textarea>
      </div>
      <button class="btn btn-primary btn-sm">의견 남기기</button>
    </form>
  </div>

  <div class="section">
    <h4>최근 의견</h4>
    <ul class="list-group">
      <?php foreach ($recent_comments as $c): ?>
        <li class="list-group-item"><?= htmlspecialchars($c['text']) ?> <small class="text-muted">(<?= date("H:i", $c['time']) ?>)</small></li>
      <?php endforeach; ?>
    </ul>
  </div>

</div>
</body>
</html>
