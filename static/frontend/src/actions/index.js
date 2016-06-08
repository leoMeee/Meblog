import fetch from 'isomorphic-fetch'
import * as  actionType from  '../constants/ActionTypes';
import * as  Api from  '../constants/Api';

function receivePosts(posts) {
    return {
        type: actionType.RECEIVE_POSTS,
        posts
    }
}

function receiveNav(nav) {
    return {
        type: actionType.RECEIVE_NAV,
        nav
    }
}

function receiveBanner(banner) {
    return {
        type: actionType.RECEIVE_BANNER,
        banner
    }
}


export function fetchPosts() {
    return dispatch=> {
        return fetch(Api.POST)
            .then(response => response.json())
            .then(json=>dispatch(receivePosts(json)))
    }
}

export function fetchNav() {
    return dispatch=> {
        return fetch(Api.NAV)
            .then(response => response.json())
            .then(json=>dispatch(receiveNav(json)))
    }
}

export function fetchBanner() {
    return dispatch=> {
        return fetch(Api.BANNER)
            .then(response => response.json())
            .then(json=>dispatch(receiveBanner(json)))
    }
}

export function loadProgress(progress) {
    return {
        type: actionType.INCREASE_LOAD_PROGRESS,
        progress: progress
    }
}
