<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'mCMS 4.1')); ?> — Admin</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('styles'); ?>
    <style>
        /* ✨ Notification badge pulse animation */
        .badge-notify {
            position: absolute;
            top: -4px;
            right: -8px;
            font-size: 0.65rem;
            padding: 3px 6px;
            border-radius: 50px;
            animation: pulse-badge 1.5s infinite;
        }
        @keyframes  pulse-badge {
            0%, 100% { transform: scale(1); }
            50%       { transform: scale(1.25); }
        }
        .nav-notify-wrap { position: relative; display: inline-block; }

        /* ✨ Live search highlight */
        .search-highlight { background: #fff3cd; }

        #admin-search-wrap { margin-bottom: 10px; }
    </style>
</head>
<body>
<div id="app">

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('info')): ?>
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo e(session('info')); ?>

        </div>
    <?php endif; ?>

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <?php echo e(config('app.name', 'mCMS')); ?>

                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php if(auth()->guard()->guest()): ?>
                        <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo e(url('/')); ?>">← View Site</a></li>

                        
                        <li>
                            <a href="<?php echo e(route('get.messages')); ?>" style="position:relative;">
                                <span class="nav-notify-wrap">
                                    💬 Messages
                                    <span id="msg-badge"
                                          class="badge badge-danger badge-notify"
                                          style="display:none;">0</span>
                                </span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo e(route('user.profile')); ?>">My Profile</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('/logout')); ?>"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display:none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <?php if(auth()->guard()->check()): ?>
            <div class="col-lg-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info">
                        <a href="<?php echo e(route('home')); ?>"><strong>🏠 Dashboard</strong></a>
                    </li>
                </ul>
                <ul class="list-group">
                            <li class="list-group-item"><a href="<?php echo e(route('get.messages')); ?>">💬 Messages</a></li>
                    <li class="list-group-item"><a href="<?php echo e(route('posts')); ?>">📝 Posts</a></li>
                    <li class="list-group-item"><a href="<?php echo e(route('categories')); ?>">📂 Categories</a></li>
                    <li class="list-group-item"><a href="<?php echo e(route('tags')); ?>">🏷️ Tags</a></li>
                    <li class="list-group-item"><a href="<?php echo e(route('pages')); ?>">📄 Pages</a></li>
                    <li class="list-group-item"><a href="<?php echo e(route('pfposts')); ?>">🖼️ Portfolio Items</a></li>
                    <li class="list-group-item"><a href="<?php echo e(route('pfcategories')); ?>">🗂️ Portfolio Categories</a></li>
                    <li class="list-group-item"><a href="<?php echo e(route('settings')); ?>">⚙️ Settings</a></li>
                    <li class="list-group-item"><a href="<?php echo e(route('menu.index')); ?>">🧭 Menu Builder</a></li>
            
                    <?php if(Auth::user()->admin): ?>
                        <li class="list-group-item"><a href="<?php echo e(route('users')); ?>">👥 Users</a></li>
                    <?php endif; ?>
                    <li class="list-group-item"><a href="<?php echo e(route('user.profile')); ?>">👤 My Profile</a></li>
                </ul>
                <ul class="list-group">
                    <li class="list-group-item"><a href="<?php echo e(route('posts.trashed')); ?>">🗑️ Trashed Posts</a></li>
                    <li class="list-group-item"><a href="<?php echo e(route('pfposts.trashed')); ?>">🗑️ Trashed Portfolio</a></li>
                </ul>
            </div>
            <?php endif; ?>
            <div class="<?php echo e(Auth::check() ? 'col-lg-9' : 'col-lg-12'); ?>">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('js/app.js')); ?>"></script>


<?php if(auth()->guard()->check()): ?>
<script>
function fetchUnreadCount() {
    fetch('<?php echo e(route('messages.unread.count')); ?>', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(data => {
        const badge = document.getElementById('msg-badge');
        if (data.count > 0) {
            badge.textContent = data.count;
            badge.style.display = 'inline-block';
        } else {
            badge.style.display = 'none';
        }
    })
    .catch(() => {});
}
fetchUnreadCount();
setInterval(fetchUnreadCount, 30000);
</script>

<h1 style="color:red; text-align:center; font-weight:800; margin:20px 0;">If YOU LIKE my WORK, then BUY me a BEER :)</h1>
<img src="https://marsislav.net/revolut.png" style="display:block; margin:20px  auto 20px auto;">
<?php endif; ?>

<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH /home/marsisla/public_html/resources/views/layouts/app.blade.php ENDPATH**/ ?>