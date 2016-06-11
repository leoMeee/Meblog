import {INCREASE_LOAD_PROGRESS, LOAD_DONE} from '../constants/ActionTypes';
import {loadDone}  from '../actions'

const initialState =
{
    progress: 0,
    styles: {
        loadStyle: 'fadein',
        mainStyle: 'hide'
    }
};


export default function load(state = initialState, action) {

    switch (action.type) {
        case INCREASE_LOAD_PROGRESS:
            let progress = state.progress + parseInt(action.progress);
            return Object.assign({}, state, {progress});
            break;
        case LOAD_DONE:
            return Object.assign({}, state, {styles: action.styles});
            break;
        default:
            return state
    }
}