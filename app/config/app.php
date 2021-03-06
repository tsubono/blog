<?php
/**
* アプリの定数系設定ファイル
*/

$config = array();

// デバイスタイプ
$config['DEVICE_PC'] = 1;   // PC
$config['DEVICE_MB'] = 2;   // 携帯
$config['DEVICE_SP'] = 4;   // スマフォ
$config['DEVICE_TB'] = 8;   // タブレット

// デバイスの値一覧
$config['DEVICES'] = array(
  $config['DEVICE_PC'], $config['DEVICE_MB'], $config['DEVICE_SP'], $config['DEVICE_TB'],
);

// デバイス毎のファイル修飾子
$config['DEVICE_PREFIX'] = array(
  1 => '_pc',   // PC
  2 => '_mb',   // 携帯
  4 => '_sp',   // スマフォ
  8 => '_tb',   // タブレット
);

// デバイス毎のFC2APIキー
$config['DEVICE_FC2_KEY'] = array(
  1 => 'pc',   // PC
  2 => 'mb',   // 携帯
  4 => 'sp',   // スマフォ
  8 => 'tb',   // タブレット
);

// デバイス毎の名称
$config['DEVICE_NAME'] = array(
  1 => __('PC'),             // PC
  2 => __('Mobile phone'),   // 携帯
  4 => __('Smartphone'),     // スマフォ
  8 => __('Tablet'),         // タブレット
);

// ブログテンプレートのデバイス毎のカラム名
$config['BLOG_TEMPLATE_COLUMN'] = array(
  1 => 'template_pc_id',
  2 => 'template_mb_id',
  4 => 'template_sp_id',
  8 => 'template_tb_id',
);

// ブログテンプレートのデバイス毎のリプライタイプカラム名
$config['BLOG_TEMPLATE_REPLY_TYPE_COLUMN'] = array(
  1 => 'template_pc_reply_type',
  2 => 'template_mb_reply_type',
  4 => 'template_sp_reply_type',
  8 => 'template_tb_reply_type',
);

// 許可デバイス一覧
$config['ALLOW_DEVICES'] = array(
  $config['DEVICE_PC'], $config['DEVICE_SP'],
);
// 許可していないデバイス分を表示から削除
foreach ($config['DEVICE_NAME'] as $key => $value) {
  if (!in_array($key, $config['ALLOW_DEVICES'])) {
    unset($config['DEVICE_NAME'][$key]);
  }
}

// アプリ用定数
$config['APP'] = array(
  'DISPLAY' => array(
    'SHOW' => 0,    // 表示
    'HIDE' => 1,    // 非表示
  ),
);

// ユーザー系
$config['USER'] = array(
  'TYPE' => array(
    'NORMAL' => 0,
    'ADMIN'  => 1,
  ),
  'REGIST_SETTING' => array(
    'NONE' => 0,  // 登録は受け付けない
    'FREE' => 1,  // 誰でも登録可能
  ),
  'REGIST_STATUS' => 0,   // ユーザーの登録受付状態
);

// ブログ系
$config['BLOG'] = array(
  'START_PAGE' => array(
    'NOTICE' => 0,  // お知らせページ
    'ENTRY'  => 1,  // 記事投稿ページ
  ),
  'OPEN_STATUS' => array(
    'PUBLIC'     => 0,  // 公開
    'PRIVATE'    => 1,  // プライベートモード(パスワード保護)
  ),
  'DEFAULT_LIMIT' => 10,
  'SSL_ENABLE' => array(
    'DISABLE' => 0,  // 無効
    'ENABLE'  => 1,  // 有効
  ),
  'REDIRECT_STATUS_CODE' => array(
    'MOVED_PERMANENTLY' => 301,
    'FOUND'  => 302,
  ),
);

// ブログテンプレート
$config['BLOG_TEMPLATE'] = array(
  'COMMENT_TYPE' => array(
    'AFTER' => 1,      // 一つ下にコメントを差し込むタイプ
    'REPLY' => 2,      // １対１でコメントを返信するタイプ
  ),
);

// ブログプラグイン
$config['BLOG_PLUGIN'] = array(
  'CATEGORY' => array(
    'FIRST'  => 1,     // 1番目
    'SECOND' => 2,     // 2番目
    'THIRD'  => 3,     // 3番目
  ),
);

// 記事系
$config['ENTRY'] = array(
  // 公開設定
  'OPEN_STATUS' => array(
    'OPEN'        => 1,  // 公開
    'PASSWORD'    => 2,  // パスワード保護
    'DRAFT'       => 3,  // 下書き
    'LIMIT'       => 4,  // 期間限定
    'RESERVATION' => 5,  // 予約投稿
  ),
  // コメント受付
  'COMMENT_ACCEPTED' => array(
    'ACCEPTED' => 1,  // 受け付ける
    'REJECT'   => 0,  // 受け付けない
  ),
  // 自動改行
  'AUTO_LINEFEED' => array(
    'USE'  => 1,  // 自動改行を行う
    'NONE' => 0,  // 行わない
  ),
  // 記事の表示順
  'ORDER' => array(
    'ASC'  => 0,
    'DESC' => 1,
  ),
  // 記事一覧の表示件数リスト
  'LIMIT_LIST' => array(
    10   => '10' . __(' results'),
    20   => '20' . __(' results'),
    40   => '40' . __(' results'),
    60   => '60' . __(' results'),
    80   => '80' . __(' results'),
    100  => '100' . __(' results'),
  ),
  'DEFAULT_LIMIT' => 20,
);

// コメント系
$config['COMMENT'] = array(
  'OPEN_STATUS' => array(
    'PUBLIC'  => 0,  // 全体公開
    'PENDING' => 2,  // 承認待ち
    'PRIVATE' => 1,  // 管理者のみ公開
  ),
  // コメントの確認設定
  'COMMENT_CONFIRM' => array(
    'THROUGH' => 0,  // 確認せずにそのまま表示
    'CONFIRM' => 1,  // コメントを確認する
  ),
  // 承認中、非公開コメントの代替コメント表示可否
  'COMMENT_DISPLAY' => array(
    'SHOW' => 0,    // 表示
    'HIDE' => 1,    // 非表示
  ),
  // コメント投稿時の名前、メールアドレス、URLを保存するかどうか
  'COMMENT_COOKIE_SAVE' => array(
    'NOT_SAVE' => 0,
    'SAVE'     => 1,
  ),
  // コメント投稿時のCAPTCHA有無
  'COMMENT_CAPTCHA' => array(
    'NOT_USE' => 0,
    'USE'     => 1,
  ),
  // コメントの表示順
  'ORDER' => array(
    'ASC'  => 0,
    'DESC' => 1,
  ),
  // コメントの返信状態
  'REPLY_STATUS' => array(
    'UNREAD' => 1,  // 未読
    'READ'   => 2,  // 既読
    'REPLY'  => 3,  // 返信済み
  ),
  // コメントの引用を行うかどうか
  'QUOTE' => array(
    'USE'  => 0,  // 引用を行う
    'NONE' => 1,  // 行わない
  ),
);

// カテゴリー系
$config['CATEGORY'] = array(
  // カテゴリーの表示順
  'ORDER' => array(
    'ASC'  => 1,
    'DESC' => 0,
  ),
  'CREATE_LIMIT' => 100,
);

// タグ系
$config['TAG'] = array(
  // 記事一覧の表示件数リスト
  'LIMIT_LIST' => array(
    10   => '10' . __(' results'),
    20   => '20' . __(' results'),
    40   => '40' . __(' results'),
    60   => '60' . __(' results'),
    80   => '80' . __(' results'),
    100  => '100' . __(' results'),
  ),
  'DEFAULT_LIMIT' => 20,
);

// ファイル系
$config['FILE'] = array(
  // ファイルの最大サイズ
  'MAX_SIZE' => 5242880,  // 5MB
);

// ページ毎の制限設定(上にあるLIMIT_LIST系は下記の配列に順次書き換えていく)
$config['PAGE'] = array(
  // ファイルの一覧表示系
  'FILE' => array(
    'DEFAULT' => array(
      'LIMIT' => 5,
      'LIST'  => array(
        5    => '5' . __(' results'),
        10   => '10' . __(' results'),
        20   => '20' . __(' results'),
        40   => '40' . __(' results'),
        60   => '60' . __(' results'),
        80   => '80' . __(' results'),
        100  => '100' . __(' results'),
      ),
    ),
    'SP' => array(
      'LIMIT' => 15,
      'LIST'  => array(
        15  => '15' . __(' results'),
      ),
    ),
  ),
  // メディアロード用
  'FILE_AJAX' => array(
    'DEFAULT' => array('LIMIT' => 18),
    'SP' => array('LIMIT' => 15),
  ),
  // プラグイン検索一覧
  'PLUGIN' => array(
    'DEFAULT' => array(
      'LIMIT' => 20,
    ),
  ),
);

return $config;
