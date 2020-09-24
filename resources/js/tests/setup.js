// To Stop Error: "ReferenceError: window is not defined"
// Because vue-test-utils needs a browser environment
require('jsdom-global')();
