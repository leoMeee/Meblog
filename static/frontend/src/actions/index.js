import * as  actionType from  '../constants/ActionTypes';


export function loadProgress(progress) {
    return (dispatch, getState)=> {
        if (getState().load.progress >= 100) return true;
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
