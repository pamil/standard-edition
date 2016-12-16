<?php

use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\SimpleBlock;

require_once __DIR__ . '/../app/autoload.php';

final class DataBenchmark
{
    public function benchData()
    {
        $kernel = new AppKernel('test', false);
        $kernel->loadClassCache();

        for ($i = 0; $i < 50; ++$i) {
            $kernel->boot();
            $container = $kernel->getContainer();

            $documentManager = $container->get('doctrine_phpcr.odm.default_document_manager');

            $parent = $documentManager->find(null, '/cms/content');

            for ($j = 0; $j < 50; ++$j) {
                $block = new SimpleBlock();
                $block->setParentDocument($parent);
                $block->setName($i . '-' . $j);
                $block->setTitle('Lorem ipsum dolor sit amet');
                $block->setBody(<<<LOR
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempor ipsum a orci semper, id bibendum ipsum pellentesque. Pellentesque lacus tortor, mollis placerat nisi eu, lobortis porttitor neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam aliquam scelerisque convallis. Maecenas vestibulum ipsum sit amet metus volutpat tempus. Nulla pretium nulla sit amet dolor sagittis euismod. Nullam ut velit mattis, vestibulum odio id, feugiat nisi. Donec vehicula leo nisl, id consequat elit suscipit vitae.
Nulla cursus volutpat purus, non fringilla neque ullamcorper eget. In venenatis fermentum ex vel rutrum. Maecenas viverra felis purus, vel finibus velit lobortis sed. Curabitur ex erat, elementum sit amet feugiat id, aliquam non velit. Integer lobortis orci id nibh sagittis aliquam. Aliquam porta ex at elit gravida luctus. Aenean viverra laoreet leo, at dictum felis sodales ut. Nam venenatis nisl eget lectus sagittis, non feugiat enim commodo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam luctus dolor nec aliquam aliquam. Sed in mattis est. Nunc fermentum eget erat id accumsan. Praesent venenatis odio sed volutpat vestibulum. Cras sagittis urna non leo finibus blandit. Phasellus bibendum finibus massa, eu imperdiet nisi cursus sit amet.
Mauris non mi in lorem viverra dictum vel et purus. Quisque a nisi eget leo fringilla pulvinar ac ut enim. Sed nulla tortor, mollis a mi vel, euismod venenatis libero. Curabitur ex eros, cursus nec turpis eget, lacinia varius tellus. Vivamus vehicula porttitor volutpat. In consectetur elit sit amet eros congue iaculis. Pellentesque in magna eleifend, tempus velit vitae, lobortis sapien. Donec luctus, elit sit amet fringilla rhoncus, tortor enim sodales nisi, ut mollis nulla massa vel dolor. Nam interdum dignissim ante, quis convallis eros tincidunt volutpat.
Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse ut vulputate urna. Aliquam risus magna, eleifend eget tellus eu, sollicitudin pulvinar ligula. Nunc condimentum convallis nulla, sodales fermentum eros ornare eget. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vivamus eu est a elit imperdiet bibendum in nec arcu. Sed tincidunt imperdiet velit id rhoncus. Ut dictum nisl et elit imperdiet, et gravida libero pretium. Sed tincidunt molestie elementum. Pellentesque arcu velit, sodales ac sem a, iaculis placerat sapien. Pellentesque gravida ante id leo tincidunt vulputate. Donec non nisi eget justo laoreet dapibus. Cras ut arcu ut est malesuada mollis. Duis sit amet arcu nec elit consectetur semper at sit amet mauris.
Vestibulum a ligula ac sem malesuada molestie. Ut eleifend dapibus condimentum. Mauris rhoncus eu nulla vel ultrices. Proin efficitur, quam vitae ultrices luctus, erat velit scelerisque est, ut pretium eros ante quis sapien. Suspendisse id tincidunt tortor, sed sagittis velit. Proin ex nisl, auctor suscipit molestie sit amet, posuere finibus mi. Nulla aliquet lorem ut eleifend imperdiet. Mauris viverra sapien viverra interdum sollicitudin. Proin ut mi leo. Vestibulum eu velit id ipsum semper pharetra ut eget orci. Nulla a eros eget purus suscipit laoreet. Curabitur feugiat dignissim pulvinar.
LOR
);

                $documentManager->persist($block);
            }

            $documentManager->flush();

            $kernel->shutdown();

            gc_collect_cycles();
        }
    }
}
