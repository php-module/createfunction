<?php
/**
 * @version 2.0
 * @author Sammy
 *
 * @keywords Samils, ils, php framework
 * -----------------
 * @package Sammy\Packs\CreateFunction
 * - Autoload, application dependencies
 *
 * MIT License
 *
 * Copyright (c) 2020 Ysare
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace Sammy\Packs\CreateFunction {
  /**
   * Make sure the module base internal trait is not
   * declared in the php global scope defore creating
   * it.
   * It ensures that the script flux is not interrupted
   * when trying to run the current command by the cli
   * API.
   */
  if (!trait_exists('Sammy\Packs\CreateFunction\FunctionEvaluator')){
  /**
   * @trait FunctionEvaluator
   * Base internal trait for the
   * FunctionEvaluator module.
   * -
   * This is (in the ils environment)
   * an instance of the php module,
   * wich should contain the module
   * core functionalities that should
   * be extended.
   * -
   * For extending the module, just create
   * an 'exts' directory in the module directory
   * and boot it by using the ils directory boot.
   * -
   */
  trait FunctionEvaluator {
    /**
     * [declares description]
     * @param  string $name
     * @param  string $funcId
     * @return null
     */
    private static function declares ($name, $funcId) {
      eval ('function '.$name.' () {
        $args = func_get_args();
        $funcId = \''.$funcId.'\';

        $body = Sammy\Packs\CreateFunction::func (
          $funcId
        );

        if (!(is_array($body) && $body)){
          return;
        }

        $args_ = !isset($body[\'args\']) ? [] : (
          !is_array($body[\'args\']) ? [] : (
            $body[\'args\']
          )
        );

        $args = array_merge ($args_, $args );

        if (is_callable($body[0])) {
          return call_user_func_array ($body[0],
            $args
          );
        }
      }');
    }
  }}
}
