<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require_once '../funcLib.php';

//адрес странички с которой перенаправляемься на авторизацию
$_SESSION['page_adress']  = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if ( isset( $_COOKIE['first_name'] ) ) {
	//echo "куки";
	$userName = $_COOKIE['first_name'] . " " . $_COOKIE['last_name'];
	$userLink = "http://vk.com/id".$_COOKIE['identity'];
}else {
	if(isset($_SESSION['first_name'])){
		//echo "сессия";
		$userName=$_SESSION['first_name']." ".$_SESSION['last_name'];
		$userLink=$_SESSION['identity'];
	}
}

$commentOut = getComments($_SESSION['page_adress']); //Получаем комментарии
$commentOut=array_reverse($commentOut, true);
?>
<style>
.comment-list{
	display: block;
}
#Login{
	font-size: 15px;
}
.comment{
	margin-top: 40px;
	display: flex;
	word-wrap:break-word;
}
.comment a, .comment img{
	width:50px;
	height:50px;
	min-width: 50px;
    min-height: 50px;
}
.comment span{
	text-align: left;
	padding-left: 10px;	
	float: right;
}
.comment span p{
	font-size: 12px;
	margin:auto;
}
.comment span h4{
	margin: auto;
}
.comment span h4 a{
	text-decoration: none;
}
.comment span h4 a:hover {
	color: blue;
	text-decoration: underline;
}
</style>
<!DOCTYPE html>
<meta charset="UTF8">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>День всех влюбленных не прошел незамеченным!</title>
	<meta name="DESCRIPTION"
	      content="Белорусский государственный медицинский университет - ведущее высшее медицинское учебное учреждение Республики Беларусь, имеющее заслуженный международный авторитет и признание. На кафедрах университета обучаются 7046 студентов, 68 аспирантов и 286 клинических ординаторов, в том числе 808 иностранных студентов и 74 иностранных клинических ординатора.">
	<meta name="KEYWORDS"
	      content="Общеуниверситетские, БГМУ, белорусский государственный медицинский университет, университет, вуз, минск, образование, высшее образование, цт, централизованное тестирование, абитуриент, студент, наука, аспирантура, медицинский, врач">
	<meta name="ROBOTS" content="all">
	<meta http-equiv="X-UA-Compatible" content="IE=9">

	<meta http-equiv="Content-Type" content="text/html; CHARSET=windows-1251">
	<link
		href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700&subset=cyrillic-ext"
		rel="stylesheet" type="text/css">

	<script type="text/javascript"
	        src="http://www.bsmu.by/scripts/jquery.min.js"></script>
	<script type="text/javascript"
	        src="http://www.bsmu.by/scripts/upper.js"></script>
	<!--<script type="text/javascript">
	function saveform (data) //Скрипт отправляющий комментарий без перезагрузки страницы
	{
		var user_comment = data.user_comment.value;
		$.post('sample.php',{user_comment:user_comment},function(data){
			$('love.php').html(data);
		},'json');
	}
	</script>

	<script type="text/javascript"> //Скрипт блокирующий кнопку
	$(function(){
	  $('#send_button').click(function(){
		$(this).attr('disabled',true);
	  });
	});
	</script>

	<script type="text/javascript">
		$(function(){
		  $('#myform').submit(function(){
			if($(this).hasClass('submitted')) {
			  return false;
			} else {
			  $(('#submit_button').attr('disabled',true);
			  $(this).addClass('submitted');
			}
		  });
		});
	</script>-->
	<link rel="stylesheet" type="text/css"
	      href="http://www.bsmu.by/style_main_ru.css">
	<link rel="stylesheet" type="text/css"
	      href="http://www.bsmu.by/style_ru.css">

	<link href="http://www.bsmu.by/rss/rss.xml" rel="alternate"
	      type="application/atom+xml" title="Atom 1.0"/>
	<link rel="SHORTCUT ICON" href="/favicon.ico">

	<!--[if lt IE 9]>


	<link rel="stylesheet" type="text/css" href="/style_IE.css"
	      media="all"></link>

	<![endif]-->
	<meta name="viewport"
	      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

</head>
<body>

<div id="naviP">
	<div class="defaultP" id="menuP">
		<ul>
			<li><a href="http://www.bsmu.by/">Главная</a></li>
			<li><a href="http://www.bsmu.by/page/6/44/">Университет</a></li>
			<li><a href="http://www.bsmu.by/page/4/33/">Абитуриент</a></li>
			<li><a href="http://www.bsmu.by/page/3/32/">Студент</a></li>
			<li><a href="http://www.bsmu.by/page/5/40/">Выпускник</a></li>
			<li><a href="http://www.bsmu.by/page/8/64/">Врач</a></li>
			<li><a href="http://www.bsmu.by/qa/">Вопрос/Ответ</a></li>
		</ul>
	</div>
</div>
<div id="Header_cont">
	<div id="Logo"><a title="Главная страница" href="http://www.bsmu.by/"></a>
	</div>
	<div id="Search">
		<div id="l_box1">
			<a class="op_box1">Languages</a><span style="color: #a5a5a5;"> &nbsp;&rarr;&nbsp;Rus</span>

			<div id="underlay1"></div>
			<div id="lightbox1">
				<br/><a class="cl_box1" href="#">x</a>

				<div id="sl"><span style="color: #c5c5c5;"><strong>Supporting
							languages</strong></span></div>
				<div id="Lang">&nbsp;&nbsp;<a href="http://eng.bsmu.by/">Eng</a>&nbsp;
					<a href="http://spa.bsmu.by/">Spa</a>&nbsp; <a
						href="http://deu.bsmu.by/">Deu</a>&nbsp; <a
						href="http://ara.bsmu.by/">Ara</a>&nbsp; <a
						href="http://fra.bsmu.by/">Fra</a>&nbsp; <a
						href="http://tuk.bsmu.by/">Tuk</a>&nbsp; <a
						href="http://fas.bsmu.by/">Fas</a>&nbsp; <a
						href="http://aze.bsmu.by/">Aze</a>&nbsp; <a
						href="http://chi.bsmu.by/">Chi</a>&nbsp; <a
						href="http://heb.bsmu.by/">Heb</a>&nbsp;</div>
			</div>
		</div>
		<form name="frmsearch" class="search" method=GET
		      action="http://www.bsmu.by/search/">
			<div><input class=search_input name=words maxlength=120
			            value=''><input type=image class=search_image
			                            title="Найти" alt="Найти"
			                            src="http://www.bsmu.by/design/search_ru.gif">
			</div>
		</form>
		<a href="http://www.bsmu.by/map/">Карта сайта</a>
	</div>
</div>
<div class="niled">&nbsp;</div>
<div class="Collage">
	<div class="Collage_In"><img
			src="http://www.bsmu.by/design/kollazh_empty.gif" alt=""/></div>
</div>
<div class="Content_cont">
<script
	src="http://www.bsmu.by/scripts/jquery-ui-1.8.18.custom.min.js"></script>
<script
	src="http://www.bsmu.by/scripts/jquery.smooth-scroll.min.js"></script>
<script src="http://www.bsmu.by/scripts/photo.js"></script>
<div class="MenuMainIn">
	<h1>Новости</h1>

	<div class="news_headings"><a
			href="http://www.bsmu.by/allarticles/rubric1/">Общеуниверситетские</a>
		<a href="http://www.bsmu.by/allarticles/rubric2/">Международные</a>
		<a href="http://www.bsmu.by/allarticles/rubric3/">Учебные</a> <a
			href="http://www.bsmu.by/allarticles/rubric4/">Воспитательные</a>
		<a class="LentaRSS" href="http://www.bsmu.by/rss/rss.xml">RSS</a>
	</div>
	<div class="niled">&nbsp;</div>
</div>
<div class="OtherPages OtherPagesQNP">
<p>

<div class=path><font size="1" color="#a50000">&rarr;</font> <a
		href="http://www.bsmu.by">Главная</a> <font size="1"
                                                    color="#a50000">&rarr;</font>
	<a href="http://www.bsmu.by/allarticles/">Новости</a> <font size="1"
	                                                            color="#a50000">&rarr;</font>
	<a href="http://www.bsmu.by/allarticles/rubric1/">Общеуниверситетские</a>
</div>
</p>
<div class="NewsContent">
			<span
				style="font-family: helvetica; color: #747474; font-size: 30px;">17</span><span
		style="font-family: helvetica; font-size: 11px; color: #747474;"> февраля 2015 г.</span>

	<h1>День всех влюбленных не прошел незамеченным! Студенчество
		университета ярко и весело отметило День Святого Валентина.</h1>

	<p><img src="http://www.bsmu.by/ImgForArticles/201502171431371.jpg"
	        alt="День всех влюбленных не прошел незамеченным!"></p>

	<p>

	<p>Студенчество университета ярко и весело отметило День Святого
		Валентина. Развлекательная шоу-программа о любви, молодости и
		красоте была представлена зрителю в фойе главного корпуса.
		Выступали не только самодеятельные коллективы университета, но и
		наши юные друзья &ndash; детский ансамбль &laquo;Праменчык&raquo;
		средней школы № 101 и детская вокальная студия &laquo;Микс&raquo;
		средней школы № 161. Организаторы угощали собравшихся печеньем в
		форме сердечек &ndash; символа этого праздника.</p>

	<p>

	<div class='album'
	     alt='День всех влюбленных не прошел незамеченным!'
	     name='album620'>
		<div class='alb_cont' id='alb_cont620'>
			<div id='btn_left' class='btn_left_noactive'>&nbsp;</div>
			<div class='album_box' id='album_box620'>
				<div class='album_img' id='album_img620'
				     alt='День всех влюбленных не прошел незамеченным!'>
					<a href='http://www.bsmu.by/PhotoAlbums/201502171404072.jpg'
					   rel='lightbox[album620]' title=''
					   class='pre'><img
							src='http://www.bsmu.by/PhotoAlbums/s_201502171404072.jpg'
							width='150' height='100'></a><a
						href='http://www.bsmu.by/PhotoAlbums/201502171405503.jpg'
						rel='lightbox[album620]' title=''
						class='pre'><img
							src='http://www.bsmu.by/PhotoAlbums/s_201502171405503.jpg'
							width='150' height='100'></a><a
						href='http://www.bsmu.by/PhotoAlbums/201502171407384.jpg'
						rel='lightbox[album620]' title=''
						class='pre'><img
							src='http://www.bsmu.by/PhotoAlbums/s_201502171407384.jpg'
							width='150' height='100'></a><a
						href='http://www.bsmu.by/PhotoAlbums/201502171412075.jpg'
						rel='lightbox[album620]' title=''
						class='pre'><img
							src='http://www.bsmu.by/PhotoAlbums/s_201502171412075.jpg'
							width='150' height='100'></a><a
						href='http://www.bsmu.by/PhotoAlbums/201502171414356.jpg'
						rel='lightbox[album620]' title=''
						class='pre'><img
							src='http://www.bsmu.by/PhotoAlbums/s_201502171414356.jpg'
							width='150' height='100'></a><a
						href='http://www.bsmu.by/PhotoAlbums/201502171416537.jpg'
						rel='lightbox[album620]' title=''
						class='pre'><img
							src='http://www.bsmu.by/PhotoAlbums/s_201502171416537.jpg'
							width='150' height='100'></a><a
						href='http://www.bsmu.by/PhotoAlbums/201502171418188.jpg'
						rel='lightbox[album620]' title=''
						class='pre'><img
							src='http://www.bsmu.by/PhotoAlbums/s_201502171418188.jpg'
							width='150' height='100'></a><a
						href='http://www.bsmu.by/PhotoAlbums/201502171421019.jpg'
						rel='lightbox[album620]' title=''
						class='pre'><img
							src='http://www.bsmu.by/PhotoAlbums/s_201502171421019.jpg'
							width='150' height='100'></a><a
						href='http://www.bsmu.by/PhotoAlbums/2015021714224910.jpg'
						rel='lightbox[album620]' title=''
						class='pre'><img
							src='http://www.bsmu.by/PhotoAlbums/s_2015021714224910.jpg'
							width='150' height='100'></a><a
						href='http://www.bsmu.by/PhotoAlbums/2015021714263111.jpg'
						rel='lightbox[album620]' title=''
						class='pre'><img
							src='http://www.bsmu.by/PhotoAlbums/s_2015021714263111.jpg'
							width='150' height='100'></a><a
						href='http://www.bsmu.by/PhotoAlbums/2015021714284112.jpg'
						rel='lightbox[album620]' title=''
						class='pre'><img
							src='http://www.bsmu.by/PhotoAlbums/s_2015021714284112.jpg'
							width='150' height='100'></a><a
						href='http://www.bsmu.by/PhotoAlbums/2015021714300013.jpg'
						rel='lightbox[album620]' title=''
						class='pre'><img
							src='http://www.bsmu.by/PhotoAlbums/s_2015021714300013.jpg'
							width='150' height='100'></a><a
						href='http://www.bsmu.by/PhotoAlbums/2015021714311414.jpg'
						rel='lightbox[album620]' title=''
						class='pre'><img
							src='http://www.bsmu.by/PhotoAlbums/s_2015021714311414.jpg'
							width='150' height='100'></a></div>
			</div>
			<div id='btn_right' class='btn_right_active' alt='13'>
				&nbsp;</div>
		</div>
		<script type='text/javascript'>
			Album_pre['album620'] = [13];
		</script>
	</div>
	<div style='clear:both;'></div>
	</p>
	<p>Всех влюбленных поздравили проректор по воспитательной работе
		Манулик Владимир Александрович и заместитель начальник отдела
		организации воспитательной и внеучебной работы Первого
		Московского государственного медицинского университета им. И.М.
		Сеченова Чуфаров Алексей Сергеевич, который находился в
		университете с официальным визитом.</p>

	<p><em>Методист ОВРМ Янь Ольга Юрьевна</em></p></p>
	<br/>
	<!-- Форма отправляющая данные -->
	<?php
	if(!isset($userName)&&!isset($userLink))
	echo "<div id=\"Login\">
			<p>Вы не авторизированы. Войдите через соц-сеть</p><br />
			<a href='vk_auth2.php'><img src='../design/vk_icon.png'></a>
			</div>";
	?>
	<form class="comments" method="POST" action="../add-comment.php">
	<div class="comment-send-area">
		<?php
		if(isset($userName) && isset($userLink)){
		echo "<p>Вы вошли как: <a href='$userLink'>$userName</a>"; 
		echo "<p><a href='http://bsmu.akson.by/comments/logout.php?logout=1'>Выйти</a></p>";
		}
		?>
		<textarea name="user_comment" cols="50" rows="10"></textarea>
		<input type="submit" id="send_button"/>
		<!--onClick="saveform (this.form);return false;"-->
	</div>
	</form>		
	<div class="comment-list">
		<?
		if(is_array($commentOut)){
			foreach($commentOut as $comment){
				echo "<div class=\"comment\">".
				"<a href=\"http://vk.com/id".$comment['network_url']."\">".
				"<img src=\"".$comment['image']."\"/></a>".
				"<span> <h4>"."<a href=\"http://vk.com/id".$comment['network_url']."\">".
				$comment['first_name'] . " " . $comment['last_name'] . "</a> " 
				. $comment['add_time'] . "</h4>" . $comment['comment']."</span>".
				"</div>";
			}
		}
		?>
	</div>
	<script charset="utf-8" src="http://yandex.st/share/share.js"
	        type="text/javascript"></script>
	<!--<div data-yasharel10n="ru" data-yasharetype="none" data-yasharequickservices="facebook,twitter,vkontakte,odnoklassniki,moimir,lj,gplus,yaru,friendfeed,moikrug" class="yashare-auto-init"></div>-->
</div>
<div class="AnonsOther">
	<p>

	<div class="AnonsArtRubric">
		<div class="In"><a title="Прочитать новость"
		                   href="http://www.bsmu.by/allarticles/rubric1/article989/"><img
					src="http://www.bsmu.by/ImgForArticles/s_201502171247581.jpg"
					alt="Встреча с учащимися из Могилевской области."></a>
		</div>
		<div class="InText">
			<div><span style="font-size: 18px;">16</span> февраля</div>
			<a title="Прочитать новость"
			   href="http://www.bsmu.by/allarticles/rubric1/article989/">Встреча
				с учащимися из Могилевской области.</a><br/>Обсуждение
			вопросов поступления в БГМУ.
		</div>
	</div>
	<div class="niled">&nbsp;</div>

	<div class="AnonsArtRubric">
		<div class="In"><a title="Прочитать новость"
		                   href="http://www.bsmu.by/allarticles/rubric1/article992/"><img
					src="http://www.bsmu.by/ImgForArticles/s_201502171602131.jpg"
					alt="VI Всероссийская студенческая стоматологическая Олимпиада с международным участием"></a>
		</div>
		<div class="InText">
			<div><span style="font-size: 18px;">13</span> февраля</div>
			<a title="Прочитать новость"
			   href="http://www.bsmu.by/allarticles/rubric1/article992/">VI
				Всероссийская студенческая стоматологическая Олимпиада с
				международным участием</a><br/>- 2015.
		</div>
	</div>
	<div class="niled">&nbsp;</div>

	<div class="AnonsArtRubric">
		<div class="In"><a title="Прочитать новость"
		                   href="http://www.bsmu.by/allarticles/rubric1/article988/"><img
					src="http://www.bsmu.by/ImgForArticles/s_201502161519072.jpg"
					alt="Массовое профориентационное мероприятие."></a>
		</div>
		<div class="InText">
			<div><span style="font-size: 18px;">13</span> февраля</div>
			<a title="Прочитать новость"
			   href="http://www.bsmu.by/allarticles/rubric1/article988/">Массовое
				профориентационное мероприятие.</a><br/>Встреча со
			старшеклассниками Крупского района Минской области.
		</div>
	</div>
	<div class="niled">&nbsp;</div>

	<div class="AnonsArtRubric">
		<div class="In"><a title="Прочитать новость"
		                   href="http://www.bsmu.by/allarticles/rubric1/article986/"><img
					src="http://www.bsmu.by/ImgForArticles/s_201502121103421.jpg"
					alt="Отчетная профсоюзная конференция первичной профсоюзной организации студентов"></a>
		</div>
		<div class="InText">
			<div><span style="font-size: 18px;">12</span> февраля</div>
			<a title="Прочитать новость"
			   href="http://www.bsmu.by/allarticles/rubric1/article986/">Отчетная
				профсоюзная конференция первичной профсоюзной
				организации студентов</a><br/>БГМУ.
		</div>
	</div>
	<div class="niled">&nbsp;</div>

	<div class="AnonsArtRubric">
		<div class="In"><a title="Прочитать новость"
		                   href="http://www.bsmu.by/allarticles/rubric1/article984/"><img
					src="http://www.bsmu.by/ImgForArticles/s_201502111420041.jpg"
					alt="Диалог администрации университета и иностранных слушателей"></a>
		</div>
		<div class="InText">
			<div><span style="font-size: 18px;">11</span> февраля</div>
			<a title="Прочитать новость"
			   href="http://www.bsmu.by/allarticles/rubric1/article984/">Диалог
				администрации университета и иностранных
				слушателей</a><br/>Обсуждение вопросов организации
			учебного процесса.
		</div>
	</div>
	<div class="niled">&nbsp;</div>

	<div class="AnonsArtRubric">
		<div class="In"><a title="Прочитать новость"
		                   href="http://www.bsmu.by/allarticles/rubric1/article980/"><img
					src="http://www.bsmu.by/ImgForArticles/s_201501291343291.jpg"
					alt="Лучшая докторская диссертация 2014 года"></a>
		</div>
		<div class="InText">
			<div><span style="font-size: 18px;">29</span> января</div>
			<a title="Прочитать новость"
			   href="http://www.bsmu.by/allarticles/rubric1/article980/">Лучшая
				докторская диссертация 2014 года</a><br/>по медицинским
			наукам в Республике Беларусь.
		</div>
	</div>
	<div class="niled">&nbsp;</div>

	<div class="AnonsArtRubric">
		<div class="In"><a title="Прочитать новость"
		                   href="http://www.bsmu.by/allarticles/rubric1/article979/"><img
					src="http://www.bsmu.by/ImgForArticles/s_201501281529091.jpg"
					alt="Конференция по актуальным вопросам акушерства и гинекологии в рамках научной сессии БГМУ,"></a>
		</div>
		<div class="InText">
			<div><span style="font-size: 18px;">28</span> января</div>
			<a title="Прочитать новость"
			   href="http://www.bsmu.by/allarticles/rubric1/article979/">Конференция
				по актуальным вопросам акушерства и гинекологии в рамках
				научной сессии БГМУ,</a><br/>посвященная 85-летию
			Герасимовича Г.И.
		</div>
	</div>
	<div class="niled">&nbsp;</div>

	<div class="AnonsArtRubric">
		<div class="In"><a title="Прочитать новость"
		                   href="http://www.bsmu.by/allarticles/rubric1/article978/"><img
					src="http://www.bsmu.by/ImgForArticles/s_201501271449353i270114.jpg"
					alt="Иностранные студенты БГМУ"></a></div>
		<div class="InText">
			<div><span style="font-size: 18px;">27</span> января</div>
			<a title="Прочитать новость"
			   href="http://www.bsmu.by/allarticles/rubric1/article978/">Иностранные
				студенты БГМУ</a><br/>на балу православной молодёжи.
		</div>
	</div>
	<div class="niled">&nbsp;</div>

	</p>
</div>
</div>
<script src="http://www.bsmu.by/scripts/title.js"
        type="text/javascript"></script>
</div>
<div class="niled">&nbsp;</div>
<div id="Footer_cont">
	<div id="goverment">
		<div id="blazon"><img src="http://www.bsmu.by/design/gerb_rgb.jpg"
		                      alt=""/></div>
		<div class="govermentbox">
			<div>Президент Республики Беларусь</div>
			<a href="http://president.gov.by">president.gov.by</a>
		</div>
		<div class="govermentbox">
			<div>Совет Республики Беларусь</div>
			<a href="http://sovrep.gov.by">sovrep.gov.by</a>
		</div>
		<div class="govermentbox">
			<div>Министерство здравоохранения</div>
			<a href="http://minzdrav.gov.by">minzdrav.gov.by</a>
		</div>
		<div class="govermentbox">
			<div>Министерство образования</div>
			<a href="http://edu.gov.by">edu.gov.by</a>
		</div>
	</div>
	<div class="niled">&nbsp;</div>
	<div id="copyright1">&copy; 1921&mdash;2015 Учреждение образования &laquo;Белорусский
		государственный медицинский университет&raquo;.
	</div>
	<div id="copyright2">При перепечатке текстовой информации и фотографий&nbsp;гиперссылка
		на сайт обязательна. Все права на графические и текстовые материалы
		принадлежат их авторам.
	</div>
	<div class="niled">&nbsp;</div>
	<div id="footerinfo">
		<a href="http://www.bsmu.by/page/18/1481/">Контактная информация</a>

		<p>220116, г. Минск, пр. Дзержинского, 83<br/>Тел: +375 17 272-61-96.
			Факс: +375 17 272-61-97<br/>Эл. почта: <a
				href="mailto:bsmu@bsmu.by">bsmu@bsmu.by</a><br/><br/></p>
	</div>
	<div class="banner_Partn">
		<p><img src="http://www.bsmu.by/images/MainPage/part_m.png" alt=""
		        width="22" height="22"/><br/><a href="http://belodent.org/">Стоматологический
				информационно-образовательный портал belodent.org</a><br/><a
				title="Витебский государственный ордена Дружбы народов медицинский университе"
				href="http://www.vsmu.by/ru/">ВГМУ</a> <a
				title="Витебский государственный университет им. П. М. Машерова"
				href="http://www.vsu.by/index.php/ru/">ВГУ</a> <a
				title="Гродненский государственный медицинский университет"
				href="http://grsmu.by/">ГрГМУ</a> <a
				title="Белорусский государственный университет информатики и радиоэлектроники"
				href="http://www.bsuir.by/">БГУИР</a>&nbsp;<a
				title="Гродненский государственный университет имени Янки Купалы"
				href="http://www.grsu.by/">ГрГУ</a> <a
				title="Минский инновационный университет"
				href="http://www.miu.by/">МИУ</a> <a
				title="Брестский государственный университет имени А.С. Пушкина"
				href="http://brsu.by/">БрГУ</a> <a
				title="Гомельский государственный технический университет имени П.О. Сухого"
				href="http://gstu.by/">ГГТУ</a> <a
				title="Академия управления при Президенте Республики Беларусь"
				href="http://pac.by/">АУпПРБ</a> <a
				title="Могилевский государственный университет имени А.А. Кулешова"
				href="http://msu.mogilev.by/">МГУ</a> <a
				title="Барановичский государственный университет"
				href="http://barsu.by/">БарГУ</a></p>

		<p><a href="http://www.alexa.com/"><img
					src="http://www.bsmu.by/images/MainPage/alexa.jpg" alt=""
					width="60" height="56"/></a></p>
	</div>
</div>
<script src="http://www.bsmu.by/scripts/menu.js"
        type="text/javascript"></script>
<script src="http://www.bsmu.by/scripts/lang_box.js"
        type="text/javascript"></script>
</body>
</html>