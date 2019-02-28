=== TT Clone Detection ===
Contributors: wordpress
Requires at least: 4.9.9
Tested up to: 4.9.9
Stable tag: 4.9.9
Requires PHP: 7.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Plugin detected clones & protected current site (proxing) and block proxing on backend.
If you block on backend - IP of proxy host add to black list. Error 502 sending response for this host.

<p>Плагин для защиты от клонирования (проксирования) сайта. Клоны "попадаются в ловушку", определяется Host IP
клиента-клона.</p>
<p> По умолчанию происходит блокировка страницы методами JS после загрузки на "проксируемой" стороне (очищается всё DOM-дерево
 и выводится "502 Bad Gateway" (можно изменять в опциях);</p>
<p>При необходимости он может быть заболокирован на серверной стороне - для данного IP будет
отправляться код ответа "200"(можно изменять в опциях) в заголовке (функция доступна с версии 1.0).</p>
<p>Есть возможность отключения REST API Wordpress, для исключения парсинг путем API (функция доступна с версии 2.0).</p>

== Changelog ==

= 2.0 =
* Add option "Disable REST API"

= 1.4 =
* Add response parameters

= 1.3, 1.3.1, 1.3.2, 1.3.3 =
* Block array by mask IP
* Fix Ban Time

= 1.1, 1.2 =
* Fix Client IP For Docker

= 1.0 =
* Add Blocking clones by IP

= 0.2 =
* Init plugin