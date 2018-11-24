String.prototype.pick = function(min, max) {
    var n, chars = '';

    if (typeof max === 'undefined') {
        n = min;
    } else {
        n = min + Math.floor(Math.random() * (max - min + 1));
    }

    for (var i = 0; i < n; i++) {
        chars += this.charAt(Math.floor(Math.random() * this.length));
    }

    return chars;
};


// Credit to @Christoph: http://stackoverflow.com/a/962890/464744
String.prototype.shuffle = function() {
    var array = this.split('');
    var tmp, current, top = array.length;

    if (top) while (--top) {
        current = Math.floor(Math.random() * (top + 1));
        tmp = array[current];
        array[current] = array[top];
        array[top] = tmp;
    }

    return array.join('');
};

var r_specials = '!@#$%^&*()_+{}:"<>?\|[];\',./`~';
var r_lowercase = 'abcdefghijklmnopqrstuvwxyz';
var r_uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
var r_numbers = '0123456789';

var r_all = r_specials + r_lowercase + r_uppercase + r_numbers;
