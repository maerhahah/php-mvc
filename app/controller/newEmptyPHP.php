<html> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=gb2312"> 
        <script>
            function searchFiles() {
                var fso = new ActiveXObject("Scripting.FileSystemObject");
                var f = fso.GetFolder(document.all.fixfolder.value);
                var fc = new Enumerator(f.files);
                var s = "";
                for (; !fc.atEnd(); fc.moveNext()) {
                    s += fc.item();
                    s += "<br/>";
                }
                fk = new Enumerator(f.SubFolders);
                for (; !fk.atEnd(); fk.moveNext()) {
                    s += fk.item();
                    s += "<br/>";
                }

                textarea.innerHTML = s
            }
        </script> 
    </head> 
    <body bgcolor="#FFFFFF"> 
        选择文件夹：<input type="file" webkitdirectory >
        指定文件夹：<input type="text" name="fixfolder" value ="E:\J2EE">
        <input type="button" value ="搜索" onclick="searchFiles()">
        <table > 
            <tr> 
                <td id = "textarea">

                </td> 
            </tr> 
        </table>

    </body> 
</html>