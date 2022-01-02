<?php

namespace App\Http\Middleware;

use Closure;

class VerifyIdSong
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->id_unverify = $this->verifyId($request->id);

        return $next($request);
    }

    private function verifyId($id)
    {
        $list = [
            'b2ki2Wga0XWX', '2Lv43QXMeumT', 'lGg0mLsOT3qm', 'aCQIv6EGgdM8', 'wk1C93W74Gnf',
            'wFxBcbOz14GV', 'PKDK5YVEdgWH', 'iOYzPfp6lchL', '5z6HLpEj8AKI', 'BSthd9FKKLm3',
            'Hyda6ukMOr1t', 'PWAHV0oEsD', 'Twdo2DGj5gtH', 'VbyPgbZRh2gQ', 'sax2PPGbyi00',
            'tQNKGP7yyv9G', 'u3MT20d0KMYm', 'TxE5BQGsoQhr', "IOaiaV9MtkkE", "j8rCbSz9FwSL",
            "50WdDLSVJP6v", "YElEslNXbbGB", "iyF3ueMiZb", "rHQWmWD2s9bC", "AGK99yDDIP4b",
            "RY9OYgg3hbNw", "tkAXmPADUM", "Q1bDoVmHbTND", "tIQGzb1Uiu5D", "7_36wNUcCW",
            "VOVwKEQvNs4k", "tKRVO5cqMz", "qyUPe9Vqdc", "iAwcl3uFrp", "oRSu2NNqhkLX", "1JTwSPFQ45",
            "mwOTyVsmjix4", "yhPUx1qSRiUR", "hE1bCtLJPCvR", "wbYr0szhIz", "vXeVbmNc07", "myfo4iXZPbva",
            "105kimj0uo", "VOVwKEQvNs4k", "rHQWmWD2s9bC", "AGK99yDDIP4b", "pu4VGrhBNV", "43ZRvYrpXoWq",
            "OhpuXSCtbL", "rol7NsesQ6n8", "mVnsatZasERu", "2dbqutWRNJ", "N0i7A2VknO", "2habgFjIsh",
            "g5FMYQahK5b1", "cHK0bMnaIF1J", "vECwN2Vm4-", "4A9_SMCLdq", "me30oohV6u3W", "ute0v5YNhT",
            "Li4XudXOf6aX", "jqbZIc4EvK", "m1qmw4qcDPHS", "gO7jUJL7kc", "5JXsaym4bc", "qYi53CKjdL",
            "M-si8qAX7Q", "7cyOhLLFPH", "tF0olHFEuHfw", "pl7EwCjb0D1p", "5s6hH3QnZlgK", "4ksZjyVWBIli",
            "WFNJekVVE1", "yLMyRkjxWklO", "hMAmEXzxmc", "ASSzgqCB7C", "WjX2ycqO3vNl", "dFtuICkMngrj",
            "YVVeTevlm2Z2", "sJHeWrjcKuf0", "QxO2arH6Pl", "6Pa5KcO2uYCY", "2Q3_0fbcol", "5uKlcCFjXQ",
            "PSuSL4PJCz", "i757BD2bh4", "oYAWOOMxgUJt", "Ir2soDCr3X", "IqiMiJ7OzAXs", "3SMhVpuWLL71",
            'hvRYavvRprQm', 'c796HbREbSyS', 'C0mEdQ9KxOBX', 'Fd244OAHZ0uT', '9bQE0kjIqk8z', '2TgQszHgBcQa',
            'lKAgpHg2mhpK', 'nB8sniqhFaRC', 'qdpgTMH4lyQ6', 'lRFlmcVmSiOf', 'UEPW11kEIcrN', 'QshAj36sUGhn',
            'FP2U9Ul5O2av', 'W6o8BxVlBJ2l', 's1tnpnSTVOM2', 'RlQSLFHlrboJ', 'TkjbgpSiqh3h', 'WqprKZ3robz3',
            'JO0FjSSWG29z', 'jaHzpcQsnVxg', 'hAbr5nGg0xVB', 'g8iA7WjAQFSy', 'khfoiJOh0cYt', 'PZStXU0zgngG',
            'sdy7qfPgIfD7', 'PKufAbGyu2Cd', 'LbvnWwI7v91h', 'r3hnOOZI9TNp', 'oIxlxIm7SM0n', 'VqOmmgb1CoE6',
            'eRAmgaVR97PM', '1qDNdw6Trig1', 'fFlBZRmYpCAm', 'alnx10Fq6Gfu', 'W1C0pxBHWAFd', 'TsZFa0PxxcQC',
            'SqtFXX2VA2WU', 'pJjQgDaUjVen', 'MPvWg4M7J4kq', 'A53JFtCsbc0x', 'JlzBgaFjrBCN', 'FW1DYVpfh1Yh',
            'Fljl13PsQxAp', 'mBQR5XDdLDNY', 'gUbDrmWSDeLv', '0yIXOLqFbiCm', 'J5ESerqdalDV', 'A53JFtCsbc0x',
            'JlzBgaFjrBCN', 'hAbr5nGg0xVB', 'L65juTO2Pw40', 'y3PgfZra5776', 'a9JOEEZKm08d', 'p0jopYUZWwBL',
            'W1C0pxBHWAFd', 'fteVOKASTeC5', 'RvPINXOMrK4D', 'bPmxRfYrkAhV', 'oGEo9ClsSUcG', 'stQ0sTfpXibI',
            'SPLONffoemsa', 'loq2qHxpM9aW', 'EqkyvMOQlWCk', 'WDVhzdsGLBVI', 'oIHkzFopCXrb', 'mMUP7ReiQRBd',
            'mEXpXkPEyySA', 'PrPWmteMI0Ot', 'gNrSFeIKOZ0z', 'kjAMp35xVp6Y', 'NiAxZXVGIEsp', 'qWMPJD647Y2X',
            'Xe4LB0ewxhoG', 'iHYO4s1cdGSN', 'LaI08bWYXzNS', 'eh93bXhL5bqV', 'tO4zBhDejzdz', 'gOE9UNKbrKkr',
            '1AMgWosQYfD9'
        ];

        return in_array($id, $list);
    }
}
