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

function receiveArticle(article) {
    return {
        type: actionType.RECEIVE_ARTICLE,
        article
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

export function fetchArticle(id) {
    return dispatch=> {
        return fetch(Api.ARTICLE+'/'+id)
            .then(response => response.json())
            .then(json=>dispatch(receiveArticle(json)))
    }
}

export function loadProgress(progress) {
    return (dispatch, getState)=> {
        dispatch({
            type: actionType.INCREASE_LOAD_PROGRESS,
            progress: progress
        });
        if (getState().load.progress >= 100) dispatch(loadDone());
    }
}

export function loadDone() {
    return dispatch=> {
        dispatch({
            type: actionType.LOAD_DONE,
            styles: {
                mainStyle: 'show',
                loadStyle: 'fadeout'
            }
        });
        setTimeout(function () {
            dispatch({
                type: actionType.LOAD_DONE,
                styles: {
                    loadStyle: 'hide',
                    mainStyle: 'show'
                }
            })
        }, 600)
    };

}
