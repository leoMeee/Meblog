import {INCREASE_LOAD_PROGRESS} from '../constants/ActionTypes';

const initialState =
{
    progress: 0
};


export default function load(state = initialState, action) {

    switch (action.type) {
        case INCREASE_LOAD_PROGRESS:
            let progress = state.progress + parseInt(action.progress);
            progress = progress >= 100 ? 100 : progress;
            return Object.assign({}, state, {progress});;
            break;
        default:
            return state
    }
}