{"filter":false,"title":"upload.php","tooltip":"/upload.php","undoManager":{"mark":84,"position":84,"stack":[[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":0,"column":0},"end":{"row":0,"column":25}},"text":"$target_dir = \"uploads/\";"},{"action":"insertText","range":{"start":{"row":0,"column":25},"end":{"row":1,"column":0}},"text":"\n"},{"action":"insertLines","range":{"start":{"row":1,"column":0},"end":{"row":8,"column":0}},"lines":["$target_dir = $target_dir . basename( $_FILES[\"uploadFile\"][\"name\"]);","$uploadOk=1;","","if (move_uploaded_file($_FILES[\"uploadFile\"][\"tmp_name\"], $target_dir)) {","    echo \"The file \". basename( $_FILES[\"uploadFile\"][\"name\"]). \" has been uploaded.\";","} else {","    echo \"Sorry, there was an error uploading your file.\";"]},{"action":"insertText","range":{"start":{"row":8,"column":0},"end":{"row":8,"column":1}},"text":"}"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":0,"column":0},"end":{"row":0,"column":1}},"text":"<"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":0,"column":1},"end":{"row":0,"column":2}},"text":"/"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":0,"column":1},"end":{"row":0,"column":2}},"text":"/"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":0,"column":1},"end":{"row":0,"column":2}},"text":"?"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":0,"column":2},"end":{"row":0,"column":3}},"text":"p"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":0,"column":3},"end":{"row":0,"column":4}},"text":"h"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":0,"column":4},"end":{"row":0,"column":5}},"text":"p"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":0,"column":5},"end":{"row":1,"column":0}},"text":"\n"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":1,"column":0},"end":{"row":2,"column":0}},"text":"\n"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":10,"column":1},"end":{"row":11,"column":0}},"text":"\n"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":0},"end":{"row":12,"column":0}},"text":"\n"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":12,"column":0},"end":{"row":12,"column":1}},"text":"?"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":12,"column":1},"end":{"row":12,"column":2}},"text":">"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":1,"column":0},"end":{"row":1,"column":16}},"text":"session_start();"},{"action":"insertText","range":{"start":{"row":1,"column":16},"end":{"row":2,"column":0}},"text":"\n"},{"action":"insertLines","range":{"start":{"row":2,"column":0},"end":{"row":9,"column":0}},"lines":["if(isset($_SESSION[\"no_ktp\"])){","    $id_number = $_SESSION[\"no_ktp\"];","    $nama = $_SESSION[\"nama\"];","}","else{","    header(\"Location: ./\");","    die();"]},{"action":"insertText","range":{"start":{"row":9,"column":0},"end":{"row":9,"column":1}},"text":"}"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":9,"column":1},"end":{"row":10,"column":0}},"text":"\n"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":11,"column":15},"end":{"row":11,"column":22}},"text":"uploads"},{"action":"insertText","range":{"start":{"row":11,"column":15},"end":{"row":11,"column":16}},"text":"/"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":16},"end":{"row":11,"column":17}},"text":"d"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":17},"end":{"row":11,"column":18}},"text":"o"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":18},"end":{"row":11,"column":19}},"text":"c"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":19},"end":{"row":11,"column":20}},"text":"u"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":20},"end":{"row":11,"column":21}},"text":"m"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":21},"end":{"row":11,"column":22}},"text":"e"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":22},"end":{"row":11,"column":23}},"text":"n"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":23},"end":{"row":11,"column":24}},"text":"t"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":24},"end":{"row":11,"column":25}},"text":"s"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":27},"end":{"row":11,"column":28}},"text":"."}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":28},"end":{"row":11,"column":37}},"text":"id_number"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":28},"end":{"row":11,"column":29}},"text":"#"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":11,"column":28},"end":{"row":11,"column":29}},"text":"#"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":28},"end":{"row":11,"column":29}},"text":"$"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":39},"end":{"row":12,"column":0}},"text":"\n"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":12,"column":0},"end":{"row":13,"column":0}},"text":"\n"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":12,"column":0},"end":{"row":13,"column":0}},"text":"\n"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":13,"column":0},"end":{"row":13,"column":40}},"text":"if (!file_exists('path/to/directory')) {"},{"action":"insertText","range":{"start":{"row":13,"column":40},"end":{"row":14,"column":0}},"text":"\n"},{"action":"insertLines","range":{"start":{"row":14,"column":0},"end":{"row":15,"column":0}},"lines":["    mkdir('path/to/directory', 0777, true);"]},{"action":"insertText","range":{"start":{"row":15,"column":0},"end":{"row":15,"column":1}},"text":"}"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":13,"column":17},"end":{"row":13,"column":36}},"text":"'path/to/directory'"},{"action":"insertText","range":{"start":{"row":13,"column":17},"end":{"row":13,"column":27}},"text":"target_dir"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":13,"column":17},"end":{"row":13,"column":18}},"text":"$"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":14,"column":11},"end":{"row":14,"column":28}},"text":"path/to/directory"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":14,"column":11},"end":{"row":14,"column":12}},"text":"'"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":14,"column":10},"end":{"row":14,"column":11}},"text":"'"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":14,"column":10},"end":{"row":14,"column":11}},"text":"$"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":14,"column":11},"end":{"row":14,"column":22}},"text":"$target_dir"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":14,"column":11},"end":{"row":14,"column":12}},"text":"$"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":14,"column":26},"end":{"row":14,"column":27}},"text":"7"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":14,"column":25},"end":{"row":14,"column":26}},"text":"7"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":14,"column":25},"end":{"row":14,"column":26}},"text":"5"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":14,"column":26},"end":{"row":14,"column":27}},"text":"5"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":38},"end":{"row":11,"column":39}},"text":"."}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":39},"end":{"row":11,"column":41}},"text":"''"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":11,"column":39},"end":{"row":11,"column":41}},"text":"''"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":39},"end":{"row":11,"column":41}},"text":"\"\""}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":40},"end":{"row":11,"column":41}},"text":"/"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":11,"column":15},"end":{"row":11,"column":16}},"text":"/"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":15},"end":{"row":11,"column":16}},"text":"."}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":11,"column":16},"end":{"row":11,"column":17}},"text":"/"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":11,"column":16},"end":{"row":11,"column":17}},"text":"/"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":11,"column":15},"end":{"row":11,"column":16}},"text":"."}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":25,"column":0},"end":{"row":25,"column":27}},"text":"    header(\"Location: ./\");"},{"action":"insertText","range":{"start":{"row":25,"column":27},"end":{"row":26,"column":0}},"text":"\n"},{"action":"insertText","range":{"start":{"row":26,"column":0},"end":{"row":26,"column":10}},"text":"    die();"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":25,"column":4},"end":{"row":25,"column":5}},"text":"\\"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":25,"column":4},"end":{"row":25,"column":5}},"text":"\\"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":25,"column":0},"end":{"row":25,"column":4}},"text":"    "}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":26,"column":0},"end":{"row":26,"column":4}},"text":"    "}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":25,"column":0},"end":{"row":26,"column":0}},"text":"\n"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":24,"column":1},"end":{"row":25,"column":0}},"text":"\n"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":25,"column":0},"end":{"row":25,"column":66}},"text":"echo \"<script type='text/javascript'>alert('$message');</script>\";"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":21,"column":4},"end":{"row":21,"column":8}},"text":"echo"},{"action":"insertText","range":{"start":{"row":21,"column":4},"end":{"row":21,"column":5}},"text":"$"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":21,"column":5},"end":{"row":21,"column":6}},"text":"t"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":21,"column":6},"end":{"row":21,"column":7}},"text":"e"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":21,"column":7},"end":{"row":21,"column":8}},"text":"x"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":21,"column":8},"end":{"row":21,"column":9}},"text":"t"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":21,"column":9},"end":{"row":21,"column":10}},"text":" "}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":21,"column":10},"end":{"row":21,"column":11}},"text":"="}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":21,"column":11},"end":{"row":21,"column":12}},"text":" "}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":21,"column":12},"end":{"row":21,"column":13}},"text":" "}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":23,"column":4},"end":{"row":23,"column":9}},"text":"echo "},{"action":"insertText","range":{"start":{"row":23,"column":4},"end":{"row":23,"column":12}},"text":"$text = "}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":21,"column":5},"end":{"row":21,"column":9}},"text":"text"},{"action":"insertText","range":{"start":{"row":21,"column":5},"end":{"row":21,"column":12}},"text":"message"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":23,"column":5},"end":{"row":23,"column":9}},"text":"text"},{"action":"insertText","range":{"start":{"row":23,"column":5},"end":{"row":23,"column":12}},"text":"message"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":27,"column":0},"end":{"row":27,"column":23}},"text":"header(\"Location: ./\");"},{"action":"insertText","range":{"start":{"row":27,"column":0},"end":{"row":27,"column":47}},"text":"header(\"location:javascript://history.go(-1)\");"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":24,"column":1},"end":{"row":25,"column":0}},"text":"\n"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":29,"column":0},"end":{"row":29,"column":1}},"text":"/"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":29,"column":1},"end":{"row":29,"column":2}},"text":"/"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":28,"column":0},"end":{"row":28,"column":1}},"text":"/"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":28,"column":1},"end":{"row":28,"column":2}},"text":"/"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":28,"column":1},"end":{"row":28,"column":2}},"text":"/"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":28,"column":0},"end":{"row":28,"column":1}},"text":"/"}]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":16,"column":0},"end":{"row":16,"column":0},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1414745422072,"hash":"a0285361b75058d378e44bddc68bf4e305de5fd4"}