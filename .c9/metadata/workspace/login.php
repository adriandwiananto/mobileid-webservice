{"filter":false,"title":"login.php","tooltip":"/login.php","undoManager":{"mark":0,"position":0,"stack":[[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":7,"column":0},"end":{"row":7,"column":1}},"text":"}"},{"action":"removeLines","range":{"start":{"row":2,"column":0},"end":{"row":7,"column":0}},"nl":"\n","lines":["//timecheck","$starttime = time();","$now = time()-$starttime;","if ($now > 900) {             //stop script after 15 minutes","break;"]},{"action":"insertText","range":{"start":{"row":2,"column":0},"end":{"row":2,"column":20}},"text":"set_time_limit(120);"}]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":0,"column":0},"end":{"row":0,"column":0},"isBackwards":true},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":51,"state":"js-start","mode":"ace/mode/php"}},"timestamp":1414947620621,"hash":"279d1e2e7c8273abdf82ea095723f208f4c787ff"}