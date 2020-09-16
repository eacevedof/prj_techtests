<?php
interface Iface {
    public function method_a();
    public function method_b();
}

class H implements Iface {
    public function method_a()
    {
        // TODO: Implement method_a() method.
    }

    public function method_b()
    {
        // TODO: Implement method_b() method.
    }
}

class M {
    private Iface $oiface;
    public function __construct(Iface $iface){
        $this->oiface = $iface;
    }

    public function run(){
        $this->oiface->method_a();
        $this->oiface->method_b();
    }
}

//$oi = new Iface();