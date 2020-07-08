<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Venta;
use \Datetime;

use Symfony\Component\HttpFoundation\JsonResponse;
class VentaController extends AbstractController
{
    /**
     * @Route("/venta", name="venta")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();      
        $ventas=$this->getDoctrine()->getRepository(Venta::class)->findAll();
       
        return $this->render('venta/index.html.twig', [
            'ventas' => $ventas,
        ]);
    }
     /**
    * @Route("/nuevaVenta", name="nuevaVenta")
    */
    public function nuevaVenta(Request $request){
      
        $em = $this->getDoctrine()->getManager();
        $mensaje=null;
        $fechaHoy = new DateTime();
        $fechaHoy= $fechaHoy->format('Y-m-d');
       
         if ($request->getMethod() == 'POST') {
            $agregado=$request->request->get('agregado');
            if ($agregado == 1){
            $usuario=$request->request->get('nombre');
            $total=$request->request->get('total');         
            $fechaVenta=$request->request->get('fechaVenta');
            $observaciones=$request->request->get('observaciones');  

            $venta = new Venta();  
            $venta->setEstado('REALIZADA');
            $venta->setEntrego($total);
            $formaPago=$request->request->get('formaPago');               
            if ($formaPago == 3){
                   $cuotas=$request->request->get('Cuotas'); 
                   $entrega=$request->request->get('entrega');
                   $venta->setEntrego($entrega);
                   $venta->setCuotas($cuotas);
                    if ($entrega != $total){
                        $venta->setEstado('PENDIENTE');
                   }                         
            }  
            $venta->setTotal( $total);
            $venta->setNombre($usuario);
            $venta->setFechaVenta(new \DateTime($fechaVenta));
            $venta->setFormaPago($formaPago); 
            $venta->setObservaciones($observaciones);            
            $em->persist($venta);
            $em->flush(); 
            $mensaje ="Se ha registrado la venta";
           }else{
            $mensaje ="Se ha cancelado la venta"  ;
           }  
        }
        return $this->render('venta/nuevaVenta.html.twig', [
            'mensaje' => $mensaje,
              'fechaHoy'=>$fechaHoy  ,
            
        ]);
    }

  
  /**
    * @Route("/realizarPago", name="realizarPago")
    */
    public function realizarPago(Request $request){
        $em = $this->getDoctrine()->getManager();
        $id=$request->request->get('id');
        $entrega=$request->request->get('entrega');
        $numCuota=$request->request->get('numCuota');        
        $venta=$this->getDoctrine()->getRepository(Venta::class)->find($id);
        $sumarEntregado=$venta->getEntrego() + $entrega;
        $venta->setCuotas($numCuota);
        $venta->setEntrego($sumarEntregado);
        if($venta->getEntrego() >= $venta->getTotal()){
            $venta->setEstado("REALIZADA");
            $venta->setCuotas(null);
        }
        $em->persist($venta);
        $em->flush();     
        return new JsonResponse([  
            'results'=> 'Pago efectuado'
        ]);
    }
        /**
    * @Route("/verObservaciones", name="verObservaciones")
    */
    public function verObservaciones(Request $request){
        $em = $this->getDoctrine()->getManager();
        $id=$request->request->get('id');
          
        $venta=$this->getDoctrine()->getRepository(Venta::class)->find($id);
          
        return new JsonResponse([  
            'results'=> $venta->getObservaciones()
        ]);
    }

    

}
