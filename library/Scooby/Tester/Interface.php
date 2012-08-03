<?php
interface Scooby_Tester_Interface
{
    /**
     * executes test process.
     * @param Scooby_Tester_Request $request
     * @return Scooby_Tester_Response
     */
    public function _invoke(Scooby_Tester_Request $request)
}
