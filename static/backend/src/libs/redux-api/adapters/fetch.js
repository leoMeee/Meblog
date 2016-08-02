"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

exports.default = function (fetch) {
    return function (url, opts) {
        url = url.replace(/\/$/, '');
        if (opts.body instanceof Object) {
            var data = '';
            for (let key in opts.body) {
                data += key + '=' + encodeURI(opts.body[key]) + '&';
            }
            data = data.replace(/&$/, '');
            opts.headers['Content-Type'] = 'application/x-www-form-urlencoded';
            opts.body = data;
        }
        return fetch(url, opts).then(function (resp) {
            return resp.status == 200 ? resp.json() : {};
        });
    };
};

module.exports = exports['default'];