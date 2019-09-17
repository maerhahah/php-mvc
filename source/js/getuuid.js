function getuuid() {
    var timestamp = (new Date()).valueOf();
//例如：1280977330748  毫秒时间戳
    var rand = parseInt(Math.random() * 1000000);
    return timestamp + rand.toString();
}