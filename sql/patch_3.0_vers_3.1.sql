
ALTER TABLE `les_enseignants_formations`  DROP FOREIGN KEY `les_enseignants_formations_ibfk_1`; 

ALTER TABLE `les_enseignants_formations`   ADD CONSTRAINT `les_enseignants_formations_ibfk_1` FOREIGN KEY (`id_ens`) REFERENCES `les_usagers` (`id_usager`) ON DELETE CASCADE ON UPDATE CASCADE; 

ALTER TABLE `les_messages_recus_usagers` ADD(`dossier` varchar(40) NOT NULL);
