import {combineReducers} from 'redux';
import rest from '../store/rest';

const rootReducer = combineReducers(
    Object.assign({}, rest.reducers, {}));

export default rootReducer